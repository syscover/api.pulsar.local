@extends('web.layouts.default')

@section('title', 'Product')

@section('head')
@stop

@section('content')
    <h1>{{ $product->name }}</h1>

    <p>{!! $product->description !!}</p>

    <p>Price: {{ $product->getPrice() }} €</p>
    <p><small><strong>Tax: {{ $product->getTaxAmount() }} €</strong></small></p>

    <br><br>
    <a href="{{ route('postShoppingCart-' . user_lang(), ['slug' => $product->slug_112]) }}">
        {{ trans('www.add_to_shopping_cart') }}
    </a>
    <a href="{{ route('product-'. user_lang(), ['category' => 'xxx', 'slug' => $product->slug]) }}" class="btn btn-primary">Add to cart</a>
@stop