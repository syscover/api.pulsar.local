@extends('web.layouts.default')

@section('title', 'Shopping cart')

@section('content')
    <h1 class="margin-vertical-20">Checkout (Step 3 - payment)</h1>

    <!-- head shopping cart-->
    @include('web.includes.head_shopping_cart')
    <!-- /head shopping cart -->

    <!-- body shopping cart -->
    @include('web.includes.body_shopping_cart')
    <!-- /body shopping cart -->

    <br><br><br><br>

    <div class="row">
        <div class="col-md-6">
            <!-- amounts -->
            @include('web.includes.amounts')
            <!-- /amounts -->

            <h3>Payment</h3>
            <form action="{{ route('postCheckout03-' . user_lang()) }}" method="post">
                {{ csrf_field() }}

                <!-- 1. Pending payment -->
                <!-- 2. Payment Confirmed -->
                <input type="hidden" name="status_id" value="1" />


                <div class="form-group">
                    <label for="comments">Order comments</label>
                    <textarea class="form-control" id="comments" rows="3" name="comments"></textarea>
                </div>

                @foreach($paymentMethods as $paymentMethod)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="payment_method_id" id="exampleRadios{{ $loop->index }}" value="{{ $paymentMethod->id }}" {{ $loop->first? 'checked' : null }}>
                            {{ $paymentMethod->name }}
                        </label>
                    </div>
                @endforeach
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
        </div>
        <div class="col-md-6">
            <!-- shipping -->
            @include('web.includes.shipping')
            <!-- /shipping -->

            <hr>

            <!-- invoice -->
            @include('web.includes.invoice')
            <!-- /invoice -->
        </div>
    </div>
@endsection