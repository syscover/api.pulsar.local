@extends('web.layouts.default')

@section('title', 'Products list')

@section('head')
    <style>
        .aviable{
            font-weight: bold;
        }
    </style>
@stop

@section('content')
    <h1 class="margin-vertical-10">{{ trans_choice('common.product', 2) }}</h1>

    <div class="card-columns">

        <!--
            Show products and values from custom fields in select
        -->
        @foreach($products as $product)
            <div class="card">
                <!-- slider -->
                <div id="carouselExampleIndicators{{ $loop->index }}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($product->attachments as $attachment)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" {{ $loop->first? 'class="active"' : null }}></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($product->attachments as $attachment)
                            <div class="carousel-item {{ $loop->first? 'active' : null }}">
                                <img class="d-block img-fluid" src="{{ $attachment->url }}" alt="{{ $attachment->name }}" title="{{ $attachment->name }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators{{ $loop->index }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators{{ $loop->index }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!-- /slider -->
                <div class="card-block">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text">{!! $product->description !!}</p>

                    @if($product->fieldGroup !== null)
                        <p class="card-text">
                        @foreach($product->fieldGroup->fields as $field)

                            @if($field->values->where('lang_id', user_lang())->count() > 0)

                                <!-- custom fields with select values -->
                                    <select class="custom-select">
                                        <option>{{ $field->labels[user_lang()] }}</option>
                                        @foreach($field->values->where('lang_id', user_lang()) as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>

                            @else
                                <!-- custom fields with value without select -->
                                    {{ $field->labels[user_lang()] }} {{ $product->data['properties'][$field->name] }}
                                @endif

                            @endforeach
                        </p>
                    @endif

                    <p class="card-text">
                        Price: {{ $product->getPrice() }} €<br>
                        <small><strong>Tax: {{ $product->getTaxAmount() }} €</strong></small>
                    </p>
                    <a href="{{ route('product-'. user_lang(), ['category' => $product->categories->first()->slug, 'slug' => $product->slug]) }}" class="btn btn-primary col-4">Show</a>
                    <a href="{{ route('postShoppingCart-' . user_lang(), ['slug' => $product->slug]) }}" class="btn btn-info offset-1 col-4">{{ trans('web.add_to_shopping_cart') }}</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Camiseta</small>
                </div>
            </div>
        @endforeach
    </div>
@stop