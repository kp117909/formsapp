<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;
use App\Models\Surveys;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){

        $surveys = Surveys::all();

        return view('guest.forms',['surveys' => $surveys]);
    }

    public function showSurvey($id){
        $survey = Surveys::where('id', $id)->first();

        return view('guest.form',['survey' => $survey]);
    }

    public function showSlug($slug){
        $survey = Surveys::where('slug', $slug)->first();

        return view('guest.form',['survey' => $survey]);
    }

    public function storeResponseSurvey(Request $request){

            $answers = $request->input('answers');
            $survey_id = $request->input('survey_id');
            $type = $request->input('type');
            foreach ($answers as $questionId => $answerData) {
                if (is_array($answerData)) {
                    foreach ($answerData as $optionId => $optionValue) {
                        $answer = new SurveyResponse();
                        $answer->survey_id = $survey_id;
                        $answer->question_id = $questionId;
                        $answer->option_id = $optionId;
                        $answer->answer = "Answer by option ID";
                        $answer->save();
                    }
                } else {
                    $answer = new SurveyResponse();
                    $answer->survey_id = $survey_id;
                    $answer->question_id = $questionId;
                    if($type == "text"){
                        $answer->answer = $answerData;
                    }else{
                        $answer->option_id = $answerData;
                        $answer->answer = "Answer by option ID";
                    }
                    $answer->save();
                }
            }
            return redirect()->route('guest.forms');
    }
}
