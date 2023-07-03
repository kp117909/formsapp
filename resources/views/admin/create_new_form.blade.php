@extends('layout')

@section('content')
    <div class = "text-center">
        <h1 class="mb-3">{{__("Form App Application")}}
            <a href="{{ route('admin.index') }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>
    <div class="container d-flex align-items-center justify-content-center text-center h-100">
        <form action="{{route("forms.store")}}" method="POST">
            @csrf
            <div class = "row">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-4 form-outline mb-2">
                    <input type="text" name = "survey_name" id="survey_name" class="form-control form-control-lg" value="{{ old('survey_name') }}" />
                    <label class="form-label" for="survey_name">{{__("Survey Name")}}</label>
                </div>

                <div class="col-md-4 form-outline mb-2">
                    <input type="text" name = "survey_description" id="survey_description" class="form-control form-control-lg" value="{{ old('survey_description') }}" />
                    <label class="form-label" for="survey_description">{{__("Survey Description")}}</label>
                </div>

                <div class="col-md-4 form-outline">
                    <input type="text" name = "survey_url" id="survey_url" class="form-control form-control-lg" value="{{ old('survey_url') }}" />
                    <label class="form-label" for="survey_url">{{__("Survey URL")}}</label>
                </div>

                <div class="col-md-6 m-2">
                    <input type="checkbox" name = "public" id="public" class="form-check-input" {{ old('public') ? 'checked' : '' }}>
                    <label class="form-label" for="public">{{__("Is Public")}}</label>
                </div>

                <div class="col-md-5 m-2">
                    <input type="checkbox" name = "open" id="open" class="form-check-input" {{ old('open') ? 'checked' : '' }}>
                    <label class="form-label" for="open">{{__("Is Open")}}</label>
                </div>
            </div>
            <button class="btn btn-outline-primary btn-lg m-2" type = 'submit'>{{__("Submit")}}</button>
        </form>
    </div>
@endsection
