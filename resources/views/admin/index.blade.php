@extends('layout')

@section('content')
    <div class = "text-center">
        <h1 class="mb-3">{{__("Form App Application")}}</h1>
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
                <div class="col-md-4 form-outline mb-4">
                    <input type="text" name = "survey_name" id="survey_name" class="form-control form-control-lg" value="{{ old('survey_name    ') }}" />
                    <label class="form-label" for="survey_name">{{__("Survey Name")}}</label>
                </div>

                <div class="col-md-4 form-outline mb-4">
                    <input type="text" name = "survey_description" id="survey_description" class="form-control form-control-lg" value="{{ old('survey_description') }}" />
                    <label class="form-label" for="survey_description">{{__("Survey Description")}}</label>
                </div>
            </div>
            <button class="btn btn-outline-primary btn-lg m-2" type = 'submit'>{{__("Create new Form")}}</button>
        </form>
    </div>
    <div class = "text-center">
        <h2 class="mb-3">{{__("Current Surveys")}}</h2>
    </div>
    <div class = "container">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Created At</td>
                <td>Updated At</td>
            </tr>
            </thead>
            <tbody>
            @foreach($surveys as $survey)
                <tr>
                    <td>{{$survey->id}} <a href = "{{ route('forms.index', $survey->id) }}"><i class="fa-solid fa-right-to-bracket" style="color: #511f1f;"></i></a></td>
                    <td>{{$survey->survey_name}}</td>
                    <td>{{$survey->survey_description}}
                    <td>{{$survey->created_at}}</td>
                    <td>{{$survey->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
