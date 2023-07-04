@extends('layout')

@section('content')
<div class="container">
    <div class = "text-center">
        <h1 class = "m-3">{{__("History of answers for question")}} "{{ $question->question_text }}"
            <a href="{{ route('forms.statistic', $question->survey_id) }}" id="back" class="btn btn-primary"> <i class="fa-solid fa-share fa-rotate-180" id = "back"></i></a>
        </h1>
    </div>
            @php
                $printedOptions = [];
            @endphp
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>{{__("Latest Answers")}}</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__("Answer")}}</th>
                        <th>
                            {{__("Number")}}
                            @if ($question->question_type != 'text')
                                <i class="sort-icon fa-solid fa-sort"></i>
                            @endif
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($question->answers as $response)
                        @if ($question->question_type === 'text')
                            @if ($response->answer)
                               <tr>
                                   <td>{{ $response->answer }}</td>
                                   <td> {{__("Empty")}}</td>
                               </tr>
                            @endif
                        @else ($question->question_type === 'checkbox' || $question->question_type === 'radio')
                            @php
                                $option = $question->options()->find($response->option_id);
                            @endphp
                            @if ($option && (!in_array($response->option_id, $printedOptions)))
                                <tr>
                                    <td>{{ $option->option_text }}</td>
                                    <td>{{ $question->answers()->where('option_id', $response->option_id)->count() }}</td>
                                </tr>
                                @php
                                    $printedOptions[] = $response->option_id;
                                @endphp
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
