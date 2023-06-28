@extends('layout')

@section('content')
    @if($survey->open != 1)
        <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
            <h1 class="mb-3">{{__("Form")}} <b>{{$survey->survey_name}}</b> {{__("is closed")}}
                <a href="{{ route('guest.forms') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
            </h1>
        </div>
    @else
    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Form")}} <b>{{$survey->survey_name}}</b>
            <a href="{{ route('guest.forms') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>
    <hr>
    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Questions")}}</h1>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('survey.submit') }}" method="POST">
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        @csrf
    @foreach($survey->questions as $question)
        <div class = "row m-3">
            @if($question->is_required)
            <b>{{__("[Required]")}}</b>
            @endif
            @if($question->question_type === "text")
                    <input type="hidden" name="type" value="text">
                <div class="col-md-8 form-group">
                    <label class = "mb-4" for="question_{{$question->id}}">{{__("Question")}} {{$question->question_order}} - {{$question->question_text}}</label>
                    <input type="text" name="answers[{{$question->id}}]" data-req = "{{$question->is_required}}" class="form-control" id="question_{{$question->id}}">
                </div>
            @elseif($question->question_type === "checkbox")
                    <input type="hidden" name="type" value="checkbox">
                <div class = "col-md-6">
                    <span >{{__("Question")}} {{$question->question_order}} - {{$question->question_text}}</span>
                </div>
                @foreach($question->options as $option)
                    <div class="form-check m-3 ">
                        <input type="checkbox" name="answers[{{ $question->id }}][{{ $option->id }}]" data-req = "{{$question->is_required}}" class="form-check-input" id="$option_{{$option->id}}">
                        <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}</label>
                    </div>
                @endforeach
            @elseif($question->question_type ==="radio")
                    <input type="hidden" name="type" value="radio">
                <div class = "col-md-6">
                    <span >{{__("Question")}} {{$question->question_order}} - {{$question->question_text}}
                    </span>
                </div>
                @foreach($question->options as $option)
                    <div class="form-check m-3 ">
                        <input type="radio" name="answers[{{$question->id}}]" value = "{{$option->id}}" data-req = "{{$question->is_required}}" class="form-check-input" id="question_{{$option->id}}">
                        <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}</label>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
        <button type="submit" id = "submit-button">Wyślij</button>
    </form>
    @endif
@endsection
