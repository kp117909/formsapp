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
                <div class="col-md-4 form-outline mb-2">
                    <input type="text" name = "survey_name" id="survey_name" class="form-control form-control-lg" value="{{ old('survey_name    ') }}" />
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
                <td>[ID] Enter</td>
                <td>Name</td>
                <td>Description</td>
                <td>Public</td>
                <td>Open</td>
                <td>URL</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($surveys->reverse()  as $survey)
                <tr>
                    <td>[{{$survey->id}}] <a href = "{{ route('forms.index', $survey->id) }}"><i class="fa-solid fa-right-to-bracket bigger" style="color: #511f1f;"></i></a></td>
                    <td>{{$survey->survey_name}}</td>
                    <td>{{$survey->survey_description}}
                    <td>{{$survey->public}}</td>
                    <td>{{$survey->open}}</td>
                    <td><a target="_blank" href ="{{ config('app.url') }}{{__("/guest/form/")}}{{$survey->slug}}">{{ config('app.url') }}{{__("/guest/form/")}}{{$survey->slug}}</a></td>
                    <td>
                        <a data-url = "{{route("forms.delete")}}" data-id = "{{$survey->id}}" id = "surveyRemoveButton" class = "btn btn-danger btn-sm remove-button">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a data-url = "{{route("forms.edit")}}"
                           data-id = "{{$survey->id}}"
                           id = "surveyEditButton"
                           data-name = "{{$survey->survey_name}}"
                           data-description = "{{$survey->survey_description}}"
                           data-slug = "{{$survey->slug}}"
                           data-public = "{{$survey->public}}"
                           data-open = "{{$survey->open}}"
                           class = "btn btn-primary btn-sm survey-edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href = "{{route("forms.statistic", $survey->id)}}"  id = "surveyStatistic" class = "btn btn-warning btn-sm statistic-button">
                            <i class="fa-solid fa-chart-pie"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $surveys->links() }}
    </div>
@endsection
