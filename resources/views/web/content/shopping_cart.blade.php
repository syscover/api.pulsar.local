@extends('web.layouts.default')

@section('title', 'Shopping cart')

@section('scripts')
    @parent
    <script>
        $(function() {

            $('.increase, .decrease').on('click', function() {

                var input = $(this).siblings('input[type=hidden]');

                if ($(this).hasClass('increase'))
                    input.val(parseInt(input.val()) + 1);
                else if($(this).hasClass('decrease') && input.val() > 0)
                    input.val(parseInt(input.val()) - 1);

                $('#shoppingCartForm').submit();
            });

            $('#couponCodeBt').on('click', function() {
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: '{{ route('checkCouponCode-' . user_lang()) }}',
                    data: {
                        couponCode: $('[name=couponCode]').val()
                    },
                    success: function (data) {
                        if(data.status == 'success')
                        {
                            $('[name=applyCouponCode]').val($('[name=couponCode]').val());
                            $('#shoppingCartForm').submit();
                        }
                        else
                        {
                            var message = "<h4 class='aligncenter blue-text'>Se han encontrado los siguientes errores</h4>" +
                                    "<ul>";
                            $.each(data.errors, function (index, object) {
                                message += "<li>" + object.trans + "</li>";
                            });
                            message += "</ul>";

                            // function to set text in modal alert
                            $('#couponTextMessage').html(message);

                            // function to show modal
                            $('#couponMessageModal').modal('show');

                            setTimeout(function(){
                                $('#couponMessageModal').modal('hide');
                            }, 10000);
                        }
                    }
                });
            });
        });
    </script>
@endsection

@section('content')

    <h1 class="margin-vertical-20">{{ trans('core::common.shopping_cart') }}</h1>

    <!-- head shopping cart-->
    @include('web.includes.head_shopping_cart', ['delete' => true])
    <!-- /head shopping cart -->

    <form id="shoppingCartForm" action="{{ route('updateProduct-' . user_lang()) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="applyCouponCode">

        <!-- body shopping cart -->
        @include('web.includes.body_shopping_cart', ['quantity' => true, 'delete' => true])
        <!-- /body shopping cart -->

    </form>

    <br><br><br><br>

    <div class="row">
        <div class="col-md-6">
            <!-- amounts -->
            @include('web.includes.amounts')
            <!-- /amounts -->
        </div>

        <div class="col-md-5 ml-auto">
            <form>
                <div class="form-group">
                    <input class="form-control" name="couponCode" placeholder="{{ trans('core::common.coupon_code') }}">
                </div>
                <div class="form-group">
                    <a class="btn btn-primary" id="couponCodeBt" href="#">{{ trans('core::common.apply') }}</a>
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="{{ route('web.products-' . user_lang()) }}">{{ trans('web.continue_shopping') }}</a>
        </div>
        @if($cartItems->count() > 0)
            <div class="col-md-offset-1 col-md-3">
                <a class="btn btn-primary" href="{{ route('getCheckout01-' . user_lang()) }}">{{ trans('core::common.checkout') }}</a>
            </div>
        @endif
    </div>



    <!-- modal coupon message -->
    <div class="modal fade" id="couponMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="couponTextMessage" class="col-md-12 "></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal coupon message -->
@endsection