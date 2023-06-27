<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Options;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'questionId' => 'required|exists:questions,id',
            'text' => 'required',
        ]);

        $option = Options::create([
            'question_id' => $request->questionId,
            'option_text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Option created successfully');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'option_id' => 'required|exists:options,id',
        ]);

        $option = Options::findOrFail($request->input('option_id'));
        $option->delete();

        return redirect()->back()->with('success', 'Option deleted successfully');
    }
}
