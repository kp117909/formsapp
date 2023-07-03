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
            <ul>
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
</div>
@endsection
