@extends('web.layouts.default')

@section('title', 'Blog')

@section('head')
@endsection

@section('content')
    <h1 class="margin-vertical-20">{{ trans_choice('core::common.blog', 1) }}</h1>
    @foreach($articles as $article)
        <div class="card mb-3">
            <img class="card-img-top" {!! get_src_srcset_alt_title($article->attachments->first()) !!}>
            <div class="card-block">
                <h4 class="card-title">{{ $article->title }}</h4>
                <div class="card-text">
                    <div class="fr-view">
                        {!! $article->excerpt !!}
                    </div>
                </div>
                <p class="card-text margin-top-15">
                    <small class="text-muted">Última actualización {{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->date))->diffForHumans() }}</small>
                </p>
                <a href="{{ nt_route('web.post-' . user_lang(), ['slug' => $article->slug]) }}" class="btn btn-primary">Ver Artículo</a>
            </div>
        </div>
    @endforeach
@endsection