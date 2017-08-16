@extends('web.layouts.default')

@section('title', 'Shopping cart')

@section('scripts')
    @parent
    <script src="{{ asset('vendor/territories/js/jquery.territories.js') }}"></script>

    <script>
        $(function() {
            $.territories({
                id:                         '01',
                type:                       'laravel',
                appName:                    'pulsar',
                token:                      '{{ csrf_token() }}',
                lang:                       '{{ config('app.locale') }}',
                highlightCountrys:          ['ES','US'],

                useSeparatorHighlight:      true,
                textSeparatorHighlight:     '------------------',

                countryValue:               '{{ old('country', isset($customer->country)? $customer->country_id : null) }}',
                territorialArea1Value:      '{{ old('territorialArea1', isset($customer->territorial_area_1_id)? $customer->territorial_area_1_id : null) }}',
                territorialArea2Value:      '{{ old('territorialArea2', isset($customer->territorial_area_2_id)? $customer->territorial_area_2_id : null) }}',
                territorialArea3Value:      '{{ old('territorialArea3', isset($customer->territorial_area_3_id)? $customer->territorial_area_3_id : null) }}'
            });
        })
    </script>
@endsection

@section('content')

    <h1 class="margin-vertical-20">Checkout (Step 2 - invoice)</h1>

    <!-- head shopping cart-->
    @include('web.includes.head_shopping_cart')
    <!-- /head shopping cart -->

    <!-- body shopping cart -->
    @include('web.includes.body_shopping_cart')
    <!-- /body shopping cart -->

    <br><br><br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-7">
                    <h4>Subtotal:</h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ CartProvider::instance()->getSubtotal() }} €</h4>
                </div>
            </div>
            @foreach(CartProvider::instance()->getTaxRules() as $taxRule)
                <div class="row">
                    <div class="col-md-7">
                        <h5>{{ $taxRule->name }} ({{ $taxRule->getTaxRate() }}%)</h5>
                    </div>
                    <div class="col-md-5">
                        <h5>{{ $taxRule->getTaxAmount() }} €</h5>
                    </div>
                </div>
            @endforeach

            @foreach(CartProvider::instance()->getPriceRules() as $priceRule)
                <div class="row">
                    @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_PERCENTAGE || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_PERCENTAGE)
                    <div class="col-md-7">
                        <h5>{{ $priceRule->name }} ({{ $priceRule->getDiscountPercentage() }}%)</h5>
                    </div>
                    @endif
                    @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_FIXED_AMOUNT || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_FIXED_AMOUNT)
                        <div class="col-md-7">
                            <h5>{{ $priceRule->name }} ({{ $priceRule->getDiscountFixed() }} € )</h5>
                        </div>
                    @endif
                    <div class="col-md-5">
                        <h5>{{ $priceRule->getDiscountAmount() }}€</h5>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-7">
                    <h4>Total Discount:</h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ CartProvider::instance()->getDiscountAmount() }} €</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <h4>Total Tax:</h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ CartProvider::instance()->getTaxAmount() }} €</h4>
                </div>
            </div>
            <hr>
            @if(CartProvider::instance()->hasItemTransportable())
                <div class="row">
                    <div class="col-md-7">
                        <h4>Coste de envío:</h4>
                    </div>
                    <div class="col-md-5">
                        <h4>{{ CartProvider::instance()->getShippingAmount() }} €</h4>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-7">
                    <h4>Total:</h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ CartProvider::instance()->getTotal() }} €</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- check if cart has shipping -->
            @if(CartProvider::instance()->hasItemTransportable())
                <h3>Shipping: {{ CartProvider::instance()->getShippingAmount() }} €</h3>
                <div class="form-group">
                    <label>Name</label><br>
                    {{ $shippingData['name'] }}
                </div>
                <div class="form-group">
                    <label>Surname</label><br>
                    {{ $shippingData['surname'] }}
                </div>

                <div class="form-group">
                    <label>Country</label><br>
                    {{ $shippingCountry->name_002 }}
                </div>
                @if(isset($shippingTA1))
                    <div class="form-group">
                        <label>{{ $shippingCountry->territorial_area_1_002 }}</label><br>
                        {{ $shippingTA1->name_003 }}
                    </div>
                @endif
                @if(isset($shippingTA2))
                    <div class="form-group">
                        <label>{{ $shippingCountry->territorial_area_2_002 }}</label><br>
                        {{ $shippingTA2->name_004 }}
                    </div>
                @endif
                @if(isset($shippingTA3))
                    <div class="form-group">
                        <label>{{ $shippingCountry->territorial_area_3_002 }}</label><br>
                        {{ $shippingTA2->name_005 }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="cp">CP</label><br>
                    {{ $shippingData['cp'] }}
                </div>
                <div class="form-group">
                    <label for="address">Address</label><br>
                    {{ $shippingData['address'] }}
                </div>
            @endif

            <h3>Invoice</h3>
            <form action="{{ route('postCheckout02-' . user_lang()) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="company">Compay</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="{{ empty($customer->company_301)? null : $customer->company_301 }}">
                </div>
                <div class="form-group">
                    <label for="tin">TIN</label>
                    <input type="text" class="form-control" id="tin" name="tin" placeholder="TIN" value="{{ empty($customer->tin_301)? null : $customer->tin_301 }}">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ empty($customer->name_301)? null : $customer->name_301 }}" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ empty($customer->surname_301)? null : $customer->surname_301 }}" required>
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country" required>
                    </select>
                </div>
                <div class="form-group" id="territorialArea1Wrapper">
                    <label for="territorialArea1" id="territorialArea1Label"></label>
                    <select class="form-control" id="territorialArea1" name="territorialArea1">
                    </select>
                </div>
                <div class="form-group" id="territorialArea2Wrapper">
                    <label for="territorialArea2" id="territorialArea2Label"></label>
                    <select class="form-control" id="territorialArea2" name="territorialArea2">
                    </select>
                </div>
                <div class="form-group" id="territorialArea3Wrapper">
                    <label for="territorialArea3" id="territorialArea3Label"></label>
                    <select class="form-control" id="territorialArea3" name="territorialArea3">
                    </select>
                </div>

                <div class="form-group">
                    <label for="cp">CP</label>
                    <input type="text" class="form-control" id="cp" name="cp" placeholder="CP" value="{{ empty($customer->cp_301)? null : $customer->cp_301 }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ empty($customer->address_301)? null : $customer->address_301 }}" required>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Nex step</button>
            </form>
        </div>
    </div>
@endsection