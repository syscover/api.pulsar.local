@extends('web.layouts.default')

@section('title', 'Blog')

@section('head')
@endsection

@section('content')
    <h1 class="margin-vertical-20">{{ trans_choice('core::common.blog', 1) }}</h1>
    <!--
        Show article
    -->
    <div class="card mb-3">
        @if($article->attachments->count() > 0)
            <img class="card-img-top" {!! get_src_srcset_alt_title($article->attachments->first()) !!}>
        @endif
        <div class="card-block">
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
            <a href="{{ route('web.blog-' . user_lang()) }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@endsection