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
                <td>{{__("URL Modify")}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($completedSurveys as $survey)
                <tr>
                    <td>[{{$survey->id}}] <a href = "{{ route('response.current', $survey->survey_id) }}"><i class="fa-solid fa-right-to-bracket bigger" style="color: #511f1f;"></i></a></td>
                    <td>{{$survey->survey->survey_name}}</td>
                    <td>{{$survey->survey->survey_description}}
                    <td><a target="_blank" href ="{{ config('app.url') }}{{__("/forms/slug/")}}{{$survey->survey->slug}}">{{ config('app.url') }}{{__("/forms/")}}{{$survey->survey->slug}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $completedSurveys->links() }}
    </div>
@endsection
