@extends('web.layouts.default')

@section('title', 'Shopping cart')

@section('scripts')
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
@stop

@section('content')
    <h1>{{ trans('common.shopping_cart') }}</h1>

    <!-- heads -->
    <div class="row header-cart">
        <div class="col-md-3">
            <p>{{ trans_choice('common.product', 2) }}</p>
        </div>
        <div class="col-md-1">
            <p>{{ trans_choice('common.price', 2) }}</p>
        </div>
        <div class="col-md-1">
            <p>Qty</p>
        </div>
        <div class="col-md-1">
            <p>Subtotal</p>
        </div>
        <div class="col-md-1">
            <p>{{ trans_choice('common.discount', 2) }}</p>
        </div>
        <div class="col-md-1">
            <p>Sub + {{ trans_choice('common.discount', 2) }}</p>
        </div>
        <div class="col-md-1">
            <p>{{ trans_choice('common.tax', 2) }} %</p>
        </div>
        <div class="col-md-1">
            <p>{{ trans_choice('common.tax', 2) }} €</p>
        </div>
        <div class="col-md-1">
            <p>Total</p>
        </div>
        <div class="col-md-1">
            <p>{{ trans('common.delete') }}</p>
        </div>
    </div>
    <!-- /heads -->

    <form id="shoppingCartForm" action="{{ route('updateShoppingCart-' . user_lang()) }}" method="post">
        @foreach($cartItems as $item)
            <div class="row row-cart">
                <div class="col-md-1">
                    <img src="" class="img-responsive">
                </div>
                <div class="col-md-2">
                    <p>{{ $item->name }}</p>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getPrice() }} € / unit</p>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getQuantity() }}</p>
                    <input type="hidden" name="{{ $item->rowId }}" value="{{ $item->getQuantity() }}">
                    <a href="#" class="increase"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    <a href="#" class="decrease"><i class="fa fa-minus" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getSubtotal() }} €</p>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getDiscountAmount() }} €</p>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getSubtotalWithDiscounts() }} €</p>
                </div>
                <div class="col-md-1">
                    @foreach($item->getTaxRates() as $taxRate)
                        <p>{{ $taxRate }} %</p>
                    @endforeach
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getTaxAmount() }} €</p>
                </div>
                <div class="col-md-1">
                    <p>{{ $item->getTotal() }} €</p>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('deleteProduct-' . user_lang(), ['rowId' => $item->rowId]) }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @endforeach
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="applyCouponCode">
    </form>

    <br><br><br><br>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-7">
                    <p>Subtotal:</p>
                </div>
                <div class="col-md-5">
                    <p>{{ CartProvider::instance()->getSubtotal() }} €</p>
                </div>
            </div>
            @foreach(CartProvider::instance()->getTaxRules() as $taxRule)
                <div class="row">
                    <div class="col-md-7">
                        <p>{{ $taxRule->name }} ({{ $taxRule->getTaxRate() }}%)</p>
                    </div>
                    <div class="col-md-5">
                        <p>{{ $taxRule->getTaxAmount() }} €</p>
                    </div>
                </div>
            @endforeach

            @foreach(CartProvider::instance()->getPriceRules() as $priceRule)
                <div class="row">
                    @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_PERCENTAGE || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_PERCENTAGE)
                    <div class="col-md-7">
                        <p>{{ $priceRule->name }} ({{ $priceRule->getDiscountPercentage() }}%)</p>
                    </div>
                    @endif
                    @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_FIXED_AMOUNT || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_FIXED_AMOUNT)
                        <div class="col-md-7">
                            <p>{{ $priceRule->name }} ({{ $priceRule->getDiscountFixed() }} € )</p>
                        </div>
                    @endif
                    <div class="col-md-5">
                        <p>{{ $priceRule->getDiscountAmount() }}€</p>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-7">
                    <p>Total Discount:</p>
                </div>
                <div class="col-md-5">
                    <p{{ CartProvider::instance()->getDiscountAmount() }} €</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <p>Total Tax:</p>
                </div>
                <div class="col-md-5">
                    <p>{{ CartProvider::instance()->getTaxAmount() }} €</p>
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-md-7">--}}
                    {{--<h4>Coste de envío:</h4>--}}
                {{--</div>--}}
                {{--<div class="col-md-5">--}}
                    {{--<h3>{{ CartProvider::instance()->getShippingAmount() }} €</h3>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-7">--}}
                    {{--<h4>Coupon name</h4>--}}
                {{--</div>--}}
                {{--<div class="col-md-5">--}}
                    {{--<h3>-9999€</h3>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <div class="col-md-7">
                    <p>Total Without shipping:</p>
                </div>
                <div class="col-md-5">
                    <p>{{ CartProvider::instance()->getCartItemsTotal() }} €</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <p>Total Without shipping and without discount:</p>
                </div>
                <div class="col-md-5">
                    <p>{{ CartProvider::instance()->getCartItemsTotalWithoutDiscounts() }} €</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <p>Total:</p>
                </div>
                <div class="col-md-5">
                    <p>{{ CartProvider::instance()->getTotal() }} €</p>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="row">
                <form>
                    <div class="form-group">
                        <input class="form-control" name="couponCode" placeholder="{{ trans('common.coupon_code') }}">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" id="couponCodeBt" href="#">{{ trans('common.apply') }}</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="{{ route('productList-' . user_lang()) }}">{{ trans('web.continue_shopping') }}</a>
        </div>
        @if($cartItems->count() > 0)
            <div class="col-md-offset-1 col-md-3">
                <a class="btn btn-primary" href="{{ route('getCheckout01-' . user_lang()) }}">{{ trans('common.checkout') }}</a>
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
@stop