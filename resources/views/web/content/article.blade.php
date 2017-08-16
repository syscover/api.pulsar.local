@extends('web.layouts.default')

@section('title', 'Blog')

@section('head')
@endsection

@section('content')
    <h1 class="margin-vertical-20">{{ trans_choice('common.blog', 1) }}</h1>
    <!--
        Show article
    -->
    <div class="card mb-3">
        <img class="card-img-top"
             {!! get_src_srcset($article->attachments->first()) !!}
             alt="{{ $article->attachments->first()->name }}"
             title="{{ $article->attachments->first()->name }}">
        <div class="card-body">
            <h4 class="card-title">{{ $article->title }}</h4>
            <h6 class="card-title">{{ $article->author->name }}</h6>
            <div class="card-text">
                <div class="fr-view">
                    {!! $article->article !!}
                </div>
            </div>
            <p class="card-text margin-top-15">
                <small class="text-muted">Última actualización {{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->date))->diffForHumans() }}</small>
            </p>
            <a href="{{ route('blog-' . user_lang()) }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@endsection