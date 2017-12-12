@extends('web.layouts.default')

@section('title', 'Home')

@section('head')
@endsection

@section('content')
    <h1 class="margin-vertical-20">Review</h1>

    <form action="">
        {{ csrf_field() }}
        <input type="hidden" name="review" value="{{ $review->id }}">

        <ul>
            @foreach($review->poll->questions->where('lang_id', user_lang()) as $question)
                <li>
                    {{ $question->name }}<br>
                    {{ $question->description }}<br>
                    @if($question->type_id === 1)
                        <select name="q{{ $question->id }}">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    @endif
                    @if($question->type_id === 2)
                        <textarea name="q{{ $question->id }}"></textarea>
                    @endif
                </li>
            @endforeach
        </ul>

        <button type="submit">Enviar</button>

    </form>

@endsection