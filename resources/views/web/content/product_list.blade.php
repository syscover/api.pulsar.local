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
                        <a href="{{ route('product-'. user_lang(), ['category' => $product->categories->first()->slug, 'slug' => $product->slug]) }}" class="btn btn-primary">Show Product</a>
                        <a href="{{ route('product-'. user_lang(), ['category' => 'xxx', 'slug' => $product->slug]) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>




                    {{--{{ $product->getPrice() }} €<br>--}}

                    {{--@if(config('market.taxProductDisplayPrices') == \Syscover\ShoppingCart\Cart::PRICE_WITH_TAX)--}}
                        {{--<small><strong>{{ trans_choice('market::pulsar.tax_included', 1) }} ({{ $product->getTaxAmount() }}€)</strong></small>--}}
                    {{--@endif--}}
                    {{--@if(config('market.taxProductDisplayPrices') == \Syscover\ShoppingCart\Cart::PRICE_WITHOUT_TAX)--}}
                        {{--<small><strong>{{ trans_choice('market::pulsar.tax_not_included', 1) }} ({{ $product->getTaxAmount() }}€)</strong></small>--}}
                    {{--@endif--}}

                    {{--@foreach($product->taxRules as $taxRule)--}}
                        {{--<br>--}}
                        {{--<small>{{ trans($taxRule->translation_104) }} {{ $taxRule->getTaxRate() }}%</small>--}}
                    {{--@endforeach--}}


                    {{--<a href="{{ route('postShoppingCart-' . user_lang(), ['slug' => $product->slug_112]) }}">{{ trans('web.add_to_shopping_cart') }}</a>--}}



        @endforeach
    </div>
@stop