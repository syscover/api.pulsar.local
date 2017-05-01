@extends('web.layouts.default')

@section('title', 'Products list')

@section('head')
@stop

@section('content')
    <h1 class="margin-vertical-10">{{ trans_choice('web.product', 2) }}</h1>

    <div class="card-columns">
        @foreach($products as $product)
            <div class="card">
                <img class="card-img-top img-fluid" src="http://placehold.it/360x180" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text">{!! $product->description !!}</p>
                    <p class="card-text">Price: {{ $product->getPrice() }} €</p>
                    <p class="card-text"><small><strong>Tax: {{ $product->getTaxAmount() }} €</strong></small></p>
                    <a href="{{ route('product-'. user_lang(), ['category' => $product->categories->first()->slug, 'slug' => $product->slug]) }}" class="btn btn-primary">Show Product</a>
                    <br><br>
                    <a href="{{ route('postShoppingCart-' . user_lang(), ['slug' => $product->slug]) }}" class="btn btn-info">{{ trans('web.add_to_shopping_cart') }}</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        @endforeach
    </div>
@stop