@extends('web.layouts.default')

@section('title', 'Product')

@section('head')
@endsection

@section('content')

    <h1 class="margin-vertical-20">{{ $product->name }}</h1>

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <!-- slider -->
            <div id="carouselExampleIndicators0" class="carousel slide" data-ride="carousel">
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
                <a class="carousel-control-prev" href="#carouselExampleIndicators0" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators0" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- /slider -->
        </div>
        <div class="col-sm-12 col-md-8">
            <h3 class="margin-vertical-20">{{ $product->name }}</h3>

            <p>{!! $product->description !!}</p>

            <p>Price: {{ $product->getPrice() }} €</p>
            <p><small><strong>Tax: {{ $product->getTaxAmount() }} €</strong></small></p>

            <br><br>
            <a href="{{ route('web.add_shopping_cart-'. user_lang(), ['category' => $product->categories->first()->slug, 'slug' => $product->slug]) }}" class="btn btn-primary">{{ trans('core::common.add_to_cart') }}</a>
            <a href="{{ route('web.products-'. user_lang()) }}" class="btn btn-info">Volver</a>
        </div>
    </div>
@endsection