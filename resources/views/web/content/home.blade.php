@extends('web.layouts.default')

@section('title', 'Home')

@section('head')
@endsection

@section('content')
    <h1 class="my-20">{{ trans_choice('core::common.home', 1) }}</h1>

    <div id="app">
        <example-component></example-component>
    </div>

@endsection