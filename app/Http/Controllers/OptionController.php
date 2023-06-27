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
        $option = Options::findOrFail($request->input('id'));
        if (!$option) {
            return response()->json(['message' => 'Option not exists.'], 404);
        }


        $option->delete();

        return response()->json(['message' => 'Option deleted.']);
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $option = Options::findOrFail($request->id);

        if (!$option) {
            return response()->json(['message' => 'Option not exists.'], 404);
        }

        $request->validate([
            'option_text' => 'required',
        ]);

        $option->update([
            'option_text' => $request->option_text,
        ]);

        return response()->json(['message' => 'Question deleted.']);
    }
}
