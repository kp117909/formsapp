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
}
