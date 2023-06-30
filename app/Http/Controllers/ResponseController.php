<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Responses;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;


class ResponseController extends Controller
{

    public function index(){
        $responses = Responses::with('survey')->paginate(10);

        return view('admin.responses', ['completedSurveys' => $responses]);
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
