@extends('web.layouts.default')

@section('title', 'Checkout (Step 1 - shipping)')

@section('scripts')
    @parent
    <script src="{{ asset('vendor/territories/js/jquery.territories.js') }}"></script>
    <script>
        $(function() {
            $.territories({
                lang:                       '{{ config('app.locale') }}',
                highlightCountrys:          ['ES','US'],
                placeholderDisabled:        true,
                useSeparatorHighlight:      true,
                textSeparatorHighlight:     '------------------'
            });
        })
    </script>
@endsection

@section('content')

    <h1 class="margin-vertical-20">Checkout (Step 1 - shipping)</h1>

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
                <input type="hidden" name="has_shipping" value="1">
                <input type="hidden" name="country_id_value" value="{{ $customer->country_id }}" />
                <input type="hidden" name="territorial_area_1_id_value" value="{{ $customer->territorial_area_1_id }}" />
                <input type="hidden" name="territorial_area_2_id_value" value="{{ $customer->territorial_area_2_id }}" />
                <input type="hidden" name="territorial_area_3_id_value" value="{{ $customer->territorial_area_3_id }}" />

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" placeholder="Name" value="{{ empty($customer->name)? null : $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ empty($customer->surname)? null : $customer->surname }}" required>
                </div>

                <!-- territories -->
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country_id" required>
                    </select>
                </div>
                <div class="form-group territorial-area-1-wrapper">
                    <label for="territorial_area_1_id" class="territorial-area-1-label"></label>
                    <select class="form-control" id="territorial_area_1_id" name="territorial_area_1_id">
                    </select>
                </div>
                <div class="form-group territorial-area-2-wrapper">
                    <label for="territorial_area_2_id" class="territorial-area-2-label"></label>
                    <select class="form-control" id="territorial_area_2_id" name="territorial_area_2_id">
                    </select>
                </div>
                <div class="form-group territorial-area-3-wrapper">
                    <label for="territorial_area_3_id" class="territorial-area-3-label"></label>
                    <select class="form-control" id="territorial_area_3_id" name="territorial_area_3_id">
                    </select>
                </div>
                <!-- /territories -->

                <div class="form-group">
                    <label for="cp">CP</label>
                    <input type="text" class="form-control" id="cp" name="cp" placeholder="CP" value="{{ empty($customer->cp)? null : $customer->cp }}" required>
                </div>
                <div class="form-group">
                    <label for="locality">Locality</label>
                    <input type="text" class="form-control" id="locality" name="locality" placeholder="Locality" value="{{ empty($customer->locality)? null : $customer->locality }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ empty($customer->address)? null : $customer->address }}" required>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea type="text" class="form-control" id="comments" name="comments" placeholder="Comments"></textarea>
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
                <button class="btn btn-primary pointer">Nex step</button>
            </form>
        </div>
    </div>
    <br><br>
@endsection