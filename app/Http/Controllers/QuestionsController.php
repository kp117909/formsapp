<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Surveys;
use Illuminate\Http\Request;
class QuestionsController extends Controller
{
    public function store(Request $request)
    {

        $isRequired = $request->has('is_required') ? 1 : 0;
        $query = Questions::where('survey_id', $request->survey_id)->max('question_order') + 1;

         $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'question_text' => 'required',
            'question_type' => 'required',
        ]);

        $question = Questions::create([
            'survey_id' => $request->survey_id,
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'is_required' => $isRequired,
            'question_order' => $query,
        ]);


        return redirect()->back()->with('success', 'Question saved successfully.');
    }

    public function delete(Request $request)
    {
        $question = Questions::find($request->id);
        if (!$question) {
            return response()->json(['message' => 'Question not exists.'], 404);
        }

        $surveyId = $question->survey_id;
        $questionOrder = $question->question_order;

        $question->delete();

        $remainingQuestions = Questions::where('survey_id', $surveyId)
            ->where('question_order', '>', $questionOrder)
            ->get();

        foreach ($remainingQuestions as $remainingQuestion) {
            $remainingQuestion->decrement('question_order');
        }

        return response()->json(['message' => 'Question deleted.']);
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $question = Questions::findOrFail($request->id);

        if (!$question) {
            return response()->json(['message' => 'Question not exists.'], 404);
        }

        $request->validate([
            'question_text' => 'required',
            'is_required' => 'nullable|boolean',
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'is_required' => $request->is_required,
        ]);

        return response()->json(['message' => 'Question deleted.']);
    }

    public function changeOrder(Request $request)
    {
        $survey_id = $request->surveyId;
        $order = $request->questionOrder;

        foreach ($order as $item) {
            $id = $item['id'];
            $position = $item['position'];

            $question = Questions::where('id', $id)
                ->where('survey_id', $survey_id)
                ->first();

            if ($question) {
                $question->question_order = $position;
                $question->save();
            }
        }

        return response()->json(['message' => 'Order Updated.']);
    }

    public function currentQuestion($id){
        $question = Questions::findOrFail($id);

        return view('admin.current_statistic', ['question' => $question]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}

