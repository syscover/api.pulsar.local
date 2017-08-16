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
                token:                      '{{ csrf_token() }}',
                lang:                       '{{ config('app.locale') }}',
                highlightCountrys:          ['ES','US'],

                useSeparatorHighlight:      true,
                textSeparatorHighlight:     '------------------',

                countryValue:               '{{ old('country', isset($customer->country_id)? $customer->country_id : null) }}',
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
            <!-- amounts -->
            @include('web.includes.amounts')
            <!-- /amounts -->
        </div>
        <div class="col-md-5 ml-auto">
            <!-- check if cart has shipping -->
            @if(CartProvider::instance()->hasItemTransportable())
                <h3 class="margin-vertical-20">Shipping data</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $shippingData->get('name') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Surname</th>
                            <td>{{ $shippingData->get('surname') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Country</th>
                            <td>{{ $shippingData->get('country')->name }}</td>
                        </tr>
                        @empty(! $shippingData->has('territorial_area_1'))
                        <tr>
                            <th scope="row">{{ $shippingData->get('country')->territorial_area_1 }}</th>
                            <td> {{ $shippingData->get('territorial_area_1')->name }}</td>
                        </tr>
                        @endempty
                        @empty(! $shippingData->has('territorial_area_2'))
                            <tr>
                                <th scope="row">{{ $shippingData->get('country')->territorial_area_2 }}</th>
                                <td> {{ $shippingData->get('territorial_area_2')->name }}</td>
                            </tr>
                        @endempty

                        <tr>
                            <th scope="row">CP</th>
                            <td>{{ $shippingData['cp'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td>{{ $shippingData['address'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Comments</th>
                            <td>{{ $shippingData['comments'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Price</th>
                            <td>{{ CartProvider::instance()->getShippingAmount() }} €</td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <hr>
            <h3 class="margin-vertical-20">Invoice</h3>
            <form action="{{ route('postCheckout02-' . user_lang()) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="company">Compay</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="{{ empty($customer->company)? null : $customer->company }}">
                </div>
                <div class="form-group">
                    <label for="tin">TIN</label>
                    <input type="text" class="form-control" id="tin" name="tin" placeholder="TIN" value="{{ empty($customer->tin)? null : $customer->tin }}">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ empty($customer->name)? null : $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ empty($customer->surname)? null : $customer->surname }}" required>
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country_id" required>
                    </select>
                </div>
                <div class="form-group" id="territorialArea1Wrapper">
                    <label for="territorialArea1" id="territorialArea1Label"></label>
                    <select class="form-control" id="territorialArea1" name="territorial_area_1_id">
                    </select>
                </div>
                <div class="form-group" id="territorialArea2Wrapper">
                    <label for="territorialArea2" id="territorialArea2Label"></label>
                    <select class="form-control" id="territorialArea2" name="territorial_area_2_id">
                    </select>
                </div>
                <div class="form-group" id="territorialArea3Wrapper">
                    <label for="territorialArea3" id="territorialArea3Label"></label>
                    <select class="form-control" id="territorialArea3" name="territorial_area_3_id">
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
@endsection