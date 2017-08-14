@extends('web.layouts.default')

@section('title', 'Shopping cart')

@section('scripts')
    @parent
    <script src="{{ asset('vendor/territories/js/jquery.territories.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.territories({
                id:                         '01',
                type:                       'laravel',
                appName:                    'pulsar',
                token:                      '{{ csrf_token() }}',
                lang:                       '{{ config('app.locale') }}',
                highlightCountrys:          ['ES','US'],

                useSeparatorHighlight:      true,
                textSeparatorHighlight:     '------------------',

                countryValue:               '{{ old('country', isset($customer->country_id_301)? $customer->country_id_301 : null) }}',
                territorialArea1Value:      '{{ old('territorialArea1', isset($customer->territorial_area_1_id_301)? $customer->territorial_area_1_id_301 : null) }}',
                territorialArea2Value:      '{{ old('territorialArea2', isset($customer->territorial_area_2_id_301)? $customer->territorial_area_2_id_301 : null) }}',
                territorialArea3Value:      '{{ old('territorialArea3', isset($customer->territorial_area_3_id_301)? $customer->territorial_area_3_id_301 : null) }}'
            });
        })
    </script>
@stop

@section('content')

    <br>
    <h2>Checkout (Step 1 - shipping)</h2>
    <br>

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
        </div>


        <div class="col-md-5 ml-auto">
            <h3>Shipping: {{ CartProvider::instance()->getShippingAmount() }} €</h3>
            <form action="{{ route('postCheckout01-' . user_lang()) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" placeholder="Name" value="{{ empty($customer->name)? null : $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ empty($customer->surname)? null : $customer->surname }}" required>
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
                    <input type="text" class="form-control" id="cp" name="cp" placeholder="CP" value="{{ empty($customer->cp)? null : $customer->cp }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ empty($customer->address)? null : $customer->address }}" required>
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
    <br><br>
@stop