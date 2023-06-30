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
                <td>{{__("[ID] Enter")}}</td>
                <td>{{__("Name")}}</td>
                <td>{{__("Description")}}</td>
                <td>{{__("Date of completion")}}</td>
                <td>{{__("URL Modify")}}</td>
                <td>{{__("Actions")}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($completedSurveys->reverse() as $survey)
                <tr>
                    <td>[{{$survey->id}}] <a href = "{{ route('response.edit', $survey->response_id) }}"><i class="fa-solid fa-right-to-bracket bigger" style="color: #511f1f;"></i></a></td>
                    <td>{{$survey->survey->survey_name}}</td>
                    <td>{{$survey->survey->survey_description}}
                    <td>{{$survey->created_at}}</td>
                    <td><a target="_blank" href ="{{ config('app.url') }}{{__("/forms/")}}{{$survey->survey->slug}}">{{ config('app.url') }}{{__("/forms/")}}{{$survey->survey->slug}}</a></td>
                    <td>
                        <a data-url = "{{route("response.delete")}}" data-id = "{{$survey->id}}" id = "surveyRemoveButton" class = "btn btn-danger btn-sm remove-button">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $completedSurveys->links() }}
    </div>
@endsection
