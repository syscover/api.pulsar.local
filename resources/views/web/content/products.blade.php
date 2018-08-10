@extends('web.layouts.default')

@section('title', 'Products list')

@section('head')
    <style>
        .aviable{
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <h1 class="my-20">{{ trans_choice('core::common.product', 2) }}</h1>

    <div class="card-columns">

        <!--
            Show products and values from custom fields in select
        -->
        @foreach($products as $product)

            <!-- prueba para evitar sobreescribir el trais CustomizableValues en el modelo Producto ya que tiene public function __get($name) -->
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
                                <img class="d-block img-fluid" {!! get_src_srcset_alt_title($attachment) !!}>
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
                <!-- ./slider -->

                <div class="card-body">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text">{!! $product->description !!}</p>

                    @if($product->field_group !== null)
                        <p class="card-text">
                        @foreach($product->field_group->fields as $field)

                            @if($field->values->where('lang_id', user_lang())->count() > 0)
                                <!-- custom fields with select values -->
                                <select class="custom-select">
                                    <option>{{ $field->labels->where('id', user_lang())->first()['value'] }}</option>

                                    @foreach($field->values->where('lang_id', user_lang()) as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach

                                </select>
                            @else
                                <!-- custom fields with value without select -->
                                {{ $field->labels[user_lang()] }} {{ $product->data['custom_fields'][$field->name] }}
                            @endif

                        @endforeach
                        </p>
                    @endif

                    <p class="card-text">
                        Price: {{ $product->getPrice() }} €<br>
                        <small><strong>Tax: {{ $product->getTaxAmount() }} €</strong></small>
                    </p>
                    <div>
                        <a href="{{ route('web.product-'. user_lang(), ['category' => $product->categories->first()->slug, 'slug' => $product->slug]) }}" class="btn btn-primary col-4">Show</a>
                        <a href="{{ route('web.add_shopping_cart-' . user_lang(), ['slug' => $product->slug]) }}" class="btn btn-info offset-1 col-4">{{ __('core::common.add_to_cart') }}</a>
                    </div>
                    <div class="mt-10">
                        <a href="{{ route('web.create_review-' . user_lang(), ['slug' => $product->slug]) }}" class="btn btn-primary col-4">{{ trans_choice('core::common.review', 1) }}</a>
                    </div>


                </div>
                <!-- ./card-body -->

                <div class="card-footer">
                    <small class="text-muted">Camiseta</small>
                </div>
                <!-- ./card-footer -->

            </div>
        @endforeach
    </div>
@endsection