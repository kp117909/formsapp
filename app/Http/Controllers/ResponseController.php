<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Responses;
use App\Models\SurveyResponse;
use App\Models\Surveys;
use Illuminate\Http\Request;


class ResponseController extends Controller
{

    public function index(){
        $responses = Responses::whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('responses')
                ->groupBy('survey_id');
        })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.responses', ['completedSurveys' => $responses]);
    }

    public function current($id){
        $current_responses = Responses::where('survey_id', $id)->orderByDesc('created_at')->paginate(10);

        return view('admin.responses_current', ["completedSurveys" => $current_responses]);
    }

    public function edit($id){

        $surveys = SurveyResponse::with('survey')->where('response_id', '=', $id)->get();

        return view('admin.response_edit', ['surveys' => $surveys]);
    }

    public function delete(Request $response){
        $response = Responses::findOrFail($response->id);

        if(!$response){
            return response()->json("Error", 404);
        }

        $response->delete();

        return response()->json("Response deleted");

    }

    public function deleteQuestion(Request $response){
        $question = SurveyResponse::findOrFail($response->id);

        if(!$question){
            return response()->json("Error", 404);
        }

        $question->delete();

        return response()->json("Response question deleted");

    }

    public function editQuestion(Request $response){
        $question = SurveyResponse::findOrFail($response->id);

        if(!$question){
            return response()->json("Error", 404);
        }

        $question->answer = $response->question_text;

        $question->save();

        return response()->json("Response changed");

    }

    public function editQuestionOption(Request $response){
        $question = SurveyResponse::findOrFail($response->id);

        if(!$question){
            return response()->json("Error", 404);
        }

        $question->option_id = $response->selectedOption;

        $question->save();

        return response()->json("Response changed");

    }
}
