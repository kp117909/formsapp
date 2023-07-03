@extends('layout')

@section('content')
<div class="container">

    <div class = "text-center">
        <h1 class = "m-3">{{__("History of answers for survey ")}} "{{ $survey->survey_name }}"
            <a href="{{ route('admin.index') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>

    <hr>
    <h2>{{__("Click on icon to see detailed statistic: ")}}</h2><br></br>

    @foreach ($survey->questions as $question)
        <h3>{{_("Question: ")}} {{$question->question_text }}
            <a href = "{{route('forms.statistic.currentQuestion', $question->id)}}">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </h3>
        <hr>
    @endforeach
@endsection
