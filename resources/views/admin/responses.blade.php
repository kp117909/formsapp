@extends('layout')

@section('content')
    <div class = "text-center">
        <h1 class="mb-3">{{__("Form App Application")}}</h1>
    </div>
    <div class = "text-center">
        <h2 class="mb-3">{{__("Responses Surveys")}}</h2>
    </div>
    <div class = "container">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <td>[ID] Enter</td>
                <td>Name</td>
                <td>Description</td>
                <td>Date of completion</td>
                <td>URL Modify</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($completedSurveys as $survey)
                <tr>
                    <td>[{{$survey->id}}] <a href = "{{ route('response.edit', $survey->response_id) }}"><i class="fa-solid fa-right-to-bracket bigger" style="color: #511f1f;"></i></a></td>
                    <td>{{$survey->survey->survey_name}}</td>
                    <td>{{$survey->survey->survey_description}}
                    <td>{{$survey->created_at}}</td>
                    <td><a target="_blank" href ="{{ config('app.url') }}{{__("/forms/")}}{{$survey->survey->slug}}">{{ config('app.url') }}{{__("/forms/")}}{{$survey->survey->slug}}</a></td>
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
        {{ $completedSurveys->links() }}
    </div>
@endsection
