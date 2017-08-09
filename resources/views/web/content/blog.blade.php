@extends('web.layouts.default')

@section('title', 'Blog')

@section('head')
@stop

@section('content')
    <h1 class="margin-vertical-10">{{ trans_choice('web.blog', 1) }}</h1>
        <!--
            Show articles
        -->
        @foreach($articles as $article)
            <div class="card mb-3">
                <img class="img-fluid"
                     {!! set_srcset($article->attachments->first()) !!}
                     alt="{{ $article->attachments->first()->name }}"
                     title="{{ $article->attachments->first()->name }}">
                <div class="card-block">
                    <h4 class="card-title">{{ $article->title }}</h4>
                    <p class="card-text">{{ $article->article }}</p>
                    <p class="card-text">
                        <small class="text-muted">Última actualización {{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->date))->diffForHumans() }}</small>
                    </p>
                    <a href="{{ nt_route('article-' . user_lang(), ['slug' => $article->slug]) }}" class="btn btn-primary">Ver Artículo</a>
                </div>
            </div>
        @endforeach
@stop