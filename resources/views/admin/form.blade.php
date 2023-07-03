@extends('layout')

@section('content')

    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Editing Form")}} <b>{{$survey->survey_name}}</b>
            <a href="{{ route('admin.index') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>

    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <div id="questions">
            <div class="question">
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label for="question1">{{__("Question")}}</label>
                        <input type="text" name="question_text" class="form-control" id="question1">
                        @error('question_text')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="question_type1">{{__("Question Type:")}}</label>
                        <select name="question_type" class="form-control" id="question_type1">
                            <option value="text">{{__("Text")}}</option>
                            <option value="checkbox">{{__("MultiCheckBox")}}</option>
                            <option value="radio">{{__("RadioSingleCheck")}}</option>
                        </select>
                        @error('question_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div class="form-check">
                        <input type="checkbox" name="is_required" class="form-check-input" id="is_required1">
                        <label class="form-check-label" for="is_required1">{{__("Is Required")}}</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="add-question">{{__("Add Question")}}</button>

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
    @foreach($survey->questions as $question)
        <div class = "question-list" data-survey-id = "{{$survey->id}}" data-url = "{{route("questions.changeOrder")}}" id = "sortable" class = "row m-3">
        @if($question->question_type === "text")
                <div class="question-container" data-question-id="{{ $question->id }}">
                    <div class="col-md-8 form-group">
                        <label class = "mb-4" for="question_{{$question->id}}">{{__("Question")}} {{$question->question_order}}
                            <a data-url = "{{route("questions.edit")}}" data-id = "{{$question->id}}" id = "editButton"  data-req = "{{$question->is_required}}" data-value = "{{$question->question_text}}" class = "btn btn-primary btn-sm edit-button">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </label>
                        <input disabled type="text" name="question_text" value = "{{$question->question_text}}" class="form-control" id="question_{{$question->id}}">
                    </div>
                </div>
        @elseif($question->question_type === "checkbox")
            <div class = "question-container" data-question-id="{{ $question->id }}">
                <div data-question-id="{{ $question->id }}">
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
                            <input type="checkbox" name="option_text_{{$option->id}}" class="form-check-input" id="$option_{{$option->id}}">
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
            </div>
        @elseif($question->question_type ==="radio")
                <div class = "question-container" data-question-id="{{ $question->id }}">
                <div data-question-id="{{ $question->id }}">
                    <div class = "col-md-6">
                        <span >{{__("Question[Single]")}} {{$question->question_order}} - {{$question->question_text}}
                            <a data-url = "{{route("options.store")}}" data-id = "{{$question->id}}" id = "addButton" class = "btn btn-success btn-sm add-button">
                              <i class="fa-solid fa-plus"></i>
                            </a>
                            <a data-url = "{{route("questions.edit")}}" data-id = "{{$question->id}}" id = "editButton"  data-value = "{{$question->question_text}}" data-req = "{{$question->is_required}}" class = "btn btn-primary btn-sm edit-button">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" data-value = "{{$question->question_text}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                                <i class="fa-solid fa-trash"></i>
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
                                <a data-mdb-toggle="modal" data-mdb-target="#questionModal_{{$option->id}}" data-id="{{$option->id}}" id="editButton" data-value="{{$option->option_text}}" class="btn btn-dark btn-sm ">
                                    <i class="fa-solid fa-filter"></i>
                                </a>

                                <div class="modal fade question-modal" id="questionModal_{{$option->id}}" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                             <h5 class="modal-title" id="questionModalLabel">{{__("Choose questions to disabled when checked")}}</h5>
                                            </div>
                                            <form id="questionForm_{{$option->id}}" action="{{ route('options.setDisabled') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <select name="questionSelect[]" class="questionSelect form-control" multiple="multiple">
                                                        @foreach($survey->questions as $questionSelect)
                                                            @if($questionSelect->id != $question->id)
                                                                @if($option->blockedQuestions->isEmpty())
                                                                    <option value="{{$questionSelect->id}}">{{$questionSelect->question_text}}</option>
                                                                @elseif($option->blockedQuestions->contains('blocked_question_id', $questionSelect->id))
                                                                    <option value="{{$questionSelect->id}}" selected>{{$questionSelect->question_text}}</option>
                                                                @else
                                                                    <option value="{{$questionSelect->id}}">{{$questionSelect->question_text}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type = "button" class = "btn btn-secondary" data-dismiss="modal">{{__("Cancel")}}</button>
                                                    <input  type = "hidden" name = "option_id" value = "{{$option->id}}">
                                                    <button type="submit" data-option-id="{{$option->id}}" class="btn btn-primary send-button-disabledQuestion">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                @endforeach
                </div>
                </div>
        @endif
        </div>
    @endforeach

@endsection
