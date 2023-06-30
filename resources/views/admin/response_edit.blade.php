@extends('layout')

@section('content')

    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Editing Response")}} <b></b>
            <a href="{{ route('response.index') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>

    <form>
        @csrf
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </form>
    <hr>
    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Questions")}}</h1>
    </div>
    @foreach($surveys as $survey)
        @foreach($survey->survey->questions as $question)
            @if($survey->question_id === $question->id)
                <div class = "row m-3">
                    @if($question->question_type === "text")
                        <div class="question-container" data-question-id="{{ $question->id }}">
                            <div class="col-md-8 form-group">
                                <label class = "mb-4" for="question_{{$question->id}}">{{__("Question")}} {{$question->question_order}} - {{$question->question_text}}
                                    <a data-url = "{{route("response.editQuestion")}}" data-id = "{{$survey->id}}" id = "editButton"  data-req = "{{$question->is_required}}" data-value = "{{$survey->answer}}" class = "btn btn-primary btn-sm edit-button-response">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url = "{{route("response.deleteQuestion")}}" data-id = "{{$survey->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </label>
                                <input disabled type="text" name="question_text" value = "{{$survey->answer}}" class="form-control" id="question_{{$question->id}}">
                            </div>
                        </div>
                @elseif($question->question_type === "checkbox")
                        <div class="question-container" data-question-id="{{ $question->id }}">
                            <div class = "col-md-6">
                                <span >{{__("Question[Multi]")}} {{$question->question_order}} - {{$question->question_text}}
                                    <a data-url = "{{route("response.editQuestionOption")}}" data-id = "{{$survey->id}}" id = "editButton"  data-req = "{{$question->is_required}}" class = "btn btn-primary btn-sm edit-button-response-select">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url = "{{route("response.deleteQuestion")}}" data-id = "{{$survey->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </span>
                            </div>
                             @foreach($question->options as $option)
                                <div class="form-check m-3 ">
                                    @if($option->id == $survey->option_id)
                                        <input checked type="checkbox"  onclick="onlyOne(this)" data-option-id = "{{$option->id}}" data-option-text = "{{$option->option_text}}" name="option_text_{{$survey->id}}" class="form-check-input" id="option_{{$survey->id}}">
                                    @else
                                        <input type="checkbox" onclick="onlyOne(this)"  data-option-id = "{{$option->id}}" data-option-text = "{{$option->option_text}}" name="option_text_{{$survey->id}}" class="form-check-input" id="option_{{$survey->id}}">
                                    @endif
                                    <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}</label>
                                </div>
                            @endforeach
                        </div>
                @elseif($question->question_type ==="radio")
                        <div class="question-container" data-question-id="{{ $question->id }}">
                            <div class = "col-md-6">
                                <span >{{__("Question[Single]")}} {{$question->question_order}} - {{$question->question_text}}
                                    <a data-url = "{{route("response.editQuestionOption")}}" data-id = "{{$survey->id}}" id = "editButton"  data-req = "{{$question->is_required}}" class = "btn btn-primary btn-sm edit-button-response-select">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url = "{{route("response.deleteQuestion")}}" data-id = "{{$survey->id}}" data-value = "{{$option->option_text}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </span>
                            </div>
                            @foreach($question->options as $option)
                                <div class="form-check m-3 ">
                                    @if($option->id == $survey->option_id)
                                        <input checked type="radio" data-option-id = "{{$option->id}}" data-option-text = "{{$option->option_text}}" name="option_text_{{$survey->id}}" class="form-check-input" id="option_{{$survey->id}}">
                                    @else
                                        <input type="radio" data-option-id = "{{$option->id}}" data-option-text = "{{$option->option_text}}" name="option_text_{{$survey->id}}" class="form-check-input" id="option_{{$survey->id}}">
                                    @endif
                                    <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}
                                    </label>
                                </div>
                        @endforeach
                        </div>
                @endif
                </div>
            @endif
        @endforeach
    @endforeach

@endsection
