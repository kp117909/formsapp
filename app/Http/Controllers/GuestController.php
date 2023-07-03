<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use App\Models\Responses;
use App\Models\SurveyResponse;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function index(){

        $surveys = Surveys::query()
            ->where('public', 1)
            ->orderByDesc('created_at')
            ->paginate(10);


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
            $response_id = SurveyResponse::max('response_id') + 1;
            foreach ($answers as $questionId => $answerData) {
                if (isset($answerData) && !empty($answerData)) {
                    if (is_array($answerData)) {
                        foreach ($answerData as $optionId => $optionValue) {
                            $answer = new SurveyResponse();
                            $answer->response_id = $response_id;
                            $answer->survey_id = $survey_id;
                            $answer->question_id = $questionId;
                            $answer->option_id = $optionId;
                            $answer->answer = "Answer by option ID";
                            $answer->save();
                        }
                    } else {
                        $answer = new SurveyResponse();
                        $answer->response_id = $response_id;
                        $answer->survey_id = $survey_id;
                        $answer->question_id = $questionId;
                        $type = $request->input('type.' . $questionId);
                        if ($type === 'text') {
                            $answer->answer = $answerData;
                        } elseif ($type === 'radio') {
                            $answer->option_id = $answerData;
                            $answer->answer = "Answer by option ID";
                        }
                        $answer->save();
                    }
                }
            }

            $response = new Responses();
            $response->response_id = $response_id;
            $response->survey_id = $survey_id;
            $response->save();

        return redirect()->route('guest.forms');
    }
}
