<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormsController extends Controller
{
    public function index(){
        return view('admin.form');

    }

    public function show($slug){
        $survey = Surveys::where('slug', $slug)->first();

        return view('admin.form',['survey' => $survey]);
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
            'survey_url' => 'required',
        ]);

         $survey = Surveys::create($request->all());

         $survey->slug = Str::slug($request->input('survey_url'));

         $survey->save();

        return redirect()->route('admin.index');
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $survey = Surveys::findOrFail($request->id);

        if (!$survey) {
            return response()->json(['message' => 'Survey not exists.'], 404);
        }

        $request->validate([
            's_name' => 'required',
            's_description' => 'required',
            'slug' => 'required',
        ]);

        $survey->update([
            'survey_name' => $request->s_name,
            'survey_description' => $request->s_description,
            'slug' => $request->slug,
            'public' => $request->is_public,
            'open' => $request->is_open,
        ]);

        return response()->json(['message' => 'Survey Updated.']);
    }

    public function delete(Request $request)
    {
        $form = Surveys::findOrFail($request->input('id'));
        if (!$form) {
            return response()->json(['message' => 'Form not exists.'], 404);
        }

        $form->delete();

        return response()->json(['message' => 'Form deleted.']);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
