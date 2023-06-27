@extends('layout')

@section('content')

    <div class="container mt-3 d-flex align-items-center justify-content-center text-center h-100">
        <h1 class="mb-3">{{__("Editing Form")}} <b>{{$survey->survey_name}}</b></h1>
    </div>

    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <div id="questions">
            <div class="question">
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label for="question1">Question</label>
                        <input type="text" name="question_text" class="form-control" id="question1">
                        @error('question_text')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="question_type1">Question Type:</label>
                        <select name="question_type" class="form-control" id="question_type1">
                            <option value="text">Text</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                        </select>
                        @error('question_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div class="form-check">
                        <input type="checkbox" name="is_required" class="form-check-input" id="is_required1">
                        <label class="form-check-label" for="is_required1">Is Required</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="add-question">Add Question</button>

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
        <div class = "row m-3">
        @if($question->question_type === "text")
                <div class="col-md-8 form-group">
                    <label class = "mb-4" for="question_{{$question->id}}">{{__("Question")}} {{$question->question_order}}
                        <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </label>
                    <input type="text" name="question_text" value = "{{$question->question_text}}" class="form-control" id="question_{{$question->id}}">
                </div>
        @elseif($question->question_type === "checkbox")
                <div class = "col-md-6">
                    <span >{{__("Question")}} {{$question->question_order}} - {{$question->question_text}}
                        <a data-url = "{{route("questions.delete")}}" data-id = "{{$question->id}}" id = "removeButton" class = "btn btn-danger btn-sm remove-button">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a data-url = "{{route("options.store")}}" data-id = "{{$question->id}}" id = "addButton" class = "btn btn-success btn-sm add-button">
                          <i class="fa-solid fa-plus"></i>
                        </a>
                    </span>
                </div>
            @foreach($question->options as $option)
                <div class="form-check m-3 ">
                    <input type="checkbox" name="question_text_{{$question->id}}" class="form-check-input" id="question_{{$question->id}}">
                    <label class="form-check-label" for="question_text_{{$question->id}}">{{$option->option_text}}</label>
                </div>
                @endforeach
        @elseif($question->question_type ==="radio")
                <div class = "col-md-2">
                    <span >{{__("Question")}} {{$question->question_order}}  <a class = "btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></span>
                </div>
                <div class="form-check m-3 ">
                    <input type="radio" name="question_text_{{$question->id}}" class="form-check-input" id="question_{{$question->id}}">
                    <label class="form-check-label" for="question_text_{{$question->id}}">{{$question->question_text}}</label>
                </div>
        @endif
        </div>
    @endforeach

@endsection
