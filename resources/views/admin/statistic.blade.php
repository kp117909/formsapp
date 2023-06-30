@extends('layout')

@section('content')
<div class="container">
    <h1>{{__("History of answers for survey ")}} "{{ $survey->survey_name }}"</h1>

    @foreach ($survey->questions as $question)
        <h3>{{$question->question_text }}</h3>
        <ul>
            @php
                $printedOptions = [];
            @endphp
            @foreach ($question->answers as $response)
                @if ($question->question_type === 'text')
                    @if ($response->answer)
                        <li>
                            {{ $response->answer }}
                        </li>
                    @endif
                @elseif ($question->question_type === 'checkbox' || $question->question_type === 'radio')
                    @php
                        $option = $question->options()->find($response->option_id);
                    @endphp
                    @if ($option && (!in_array($response->option_id, $printedOptions)))
                        <li>
                            {{ $option->option_text }}
                            ({{ $question->answers()->where('option_id', $response->option_id)->count() }})
                            @php
                                $printedOptions[] = $response->option_id;
                            @endphp
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    @endforeach
</div>
@endsection
