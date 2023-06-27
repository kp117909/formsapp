<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surveys;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function index(){
        return view('admin.form');
    }

    public function showSurvey($id){

        $survey = Surveys::where('id', $id)->first();

        return view('admin.form',['survey' => $survey]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'survey_name' => 'required',
            'survey_description' => 'required',
        ]);

        Surveys::create($request->all());

        return redirect()->route('admin.index');
    }

}
