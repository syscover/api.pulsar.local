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
                <input type="hidden" name="responseType" value="redirect"> <!-- flag to instance response type, json or redirect -->
                <input type="hidden" name="newCustomer" value="error"> <!-- flag to instance that we do if customer does not exist, create or error -->
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