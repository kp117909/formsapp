@extends('layout')

@section('content')
    <div class = "text-center">
        <h2 class="mb-3">{{__("Current Surveys")}}</h2>
    </div>
    <div class = "container">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <td>{{__("ENTER")}}</td>
                <td>{{__("Name")}}</td>
                <td>{{__("Description")}}</td>
                <td>{{__("URL")}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($surveys->reverse() as $survey)
                @if($survey->public == 1)
                    <tr>
                        <td><a href = "{{ route('forms.guest', $survey->id) }}"><i class="fa-solid fa-right-to-bracket bigger" style="color: #511f1f;"></i></a></td>
                        <td>{{$survey->survey_name}}</td>
                        <td>{{$survey->survey_description}}
                        <td><a target="_blank" href ="{{ config('app.url') }}{{__("/guest/form/")}}{{$survey->slug}}">{{ config('app.url') }}{{__("/guest/form/")}}{{$survey->slug}}</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        {{ $surveys->links() }}
        </div>

    @endsection

