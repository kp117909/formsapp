@extends('layout')

@section('content')
    <div class = "text-center">
        <h1 class="mb-3">{{__("Form App Application")}}</h1>
    </div>
    <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <a href = "{{route("forms.pageNewForm")}}" class="btn btn-outline-primary btn-lg m-2" >{{__("Create new Form")}}</a>
    </div>
    <div class = "text-center">
        <h2 class="mb-3">{{__("Current Surveys")}}</h2>
    </div>
    <div class = "container">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <td>{{__("[ID] Enter")}}</td>
                <td>{{__("Name")}}</td>
                <td>{{__("Description")}}</td>
                <td>{{__("Public")}}</td>
                <td>{{__("Open")}}</td>
                <td>{{__("URL")}}</td>
                <td>{{__("Action")}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($surveys as $survey)
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
