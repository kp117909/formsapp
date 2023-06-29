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
                                    <a data-url = "{{route("questions.edit")}}" data-id = "{{$question->id}}" id = "editButton"  data-req = "{{$question->is_required}}" data-value = "{{$question->question_text}}" class = "btn btn-primary btn-sm edit-button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
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
                                    <a data-url = "{{route("options.store")}}" data-id = "{{$question->id}}" id = "addButton" class = "btn btn-success btn-sm add-button">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                     <a data-url = "{{route("questions.edit")}}" data-id = "{{$question->id}}" id = "editButton"  data-value = "{{$question->question_text}}" data-req = "{{$question->is_required}}" class = "btn btn-primary btn-sm edit-button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                   <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                        <i class="fa-solid fa-trash"></i>
                                   </a>
                                </span>
                            </div>
                             @foreach($question->options as $option)
                                <div class="form-check m-3 ">
                                    @if($option->id == $survey->option_id)
                                        <input checked type="checkbox" name="option_text_{{$option->id}}" class="form-check-input" id="$option_{{$option->id}}">
                                    @else
                                        <input type="checkbox" name="option_text_{{$option->id}}" class="form-check-input" id="$option_{{$option->id}}">
                                    @endif
                                    <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}
                                        <a data-url = "{{route("options.edit")}}" data-id = "{{$option->id}}" id = "editButton"  data-value = "{{$option->option_text}}" class = "btn btn-primary btn-sm edit-button-option">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a data-url = "{{route("options.delete")}}" data-id = "{{$option->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                @elseif($question->question_type ==="radio")
                        <div class="question-container" data-question-id="{{ $question->id }}">
                            <div class = "col-md-6">
                                <span >{{__("Question[Single]")}} {{$question->question_order}} - {{$question->question_text}}
                                    <a data-url = "{{route("options.store")}}" data-id = "{{$question->id}}" id = "addButton" class = "btn btn-success btn-sm add-button">
                                      <i class="fa-solid fa-plus"></i>
                                    </a>
                                    <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" data-value = "{{$question->question_text}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <a data-url = "{{route("questions.edit")}}" data-id = "{{$question->id}}" id = "editButton"  data-value = "{{$question->question_text}}" data-req = "{{$question->is_required}}" class = "btn btn-primary btn-sm edit-button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </span>
                            </div>
                            @foreach($question->options as $option)
                                <div class="form-check m-3 ">
                                    <input type="radio" name="option_text_single" class="form-check-input" id="question_{{$option->id}}">
                                    <label class="form-check-label" for="option_text_{{$option->id}}">{{$option->option_text}}
                                        <a data-url = "{{route("options.edit")}}" data-id = "{{$option->id}}" id = "editButton"  data-value = "{{$option->option_text}}" class = "btn btn-primary btn-sm edit-button-option">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a data-url = "{{route("options.delete")}}" data-id = "{{$option->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
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
