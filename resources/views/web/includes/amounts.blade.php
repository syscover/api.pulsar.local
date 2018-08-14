<h3 class="margin-vertical-20">Amounts</h3>
<table class="table">
    <tbody>
    <tr>
        <th scope="row">Subtotal</th>
        <td>{{ CartProvider::instance()->getSubtotal() }} €</td>
    </tr>
    @foreach(CartProvider::instance()->getTaxRules() as $taxRule)
        <tr>
            <th scope="row">{{ __($taxRule->name) }} ({{ $taxRule->getTaxRate() }}%)</th>
            <td>{{ $taxRule->getTaxAmount() }} €</td>
        </tr>
    @endforeach
    @foreach(CartProvider::instance()->getPriceRules() as $priceRule)
        <tr>
            @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_PERCENTAGE || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_PERCENTAGE)
                <th scope="row">{{ $priceRule->name }} ({{ $priceRule->getDiscountPercentage() }} %)</th>
            @endif
            @if($priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_SUBTOTAL_FIXED_AMOUNT || $priceRule->discountType == \Syscover\ShoppingCart\PriceRule::DISCOUNT_TOTAL_FIXED_AMOUNT)
                <th scope="row">{{ $priceRule->name }} ({{ $priceRule->getDiscountFixed() }} € )</th>
            @endif
            <td>{{ $priceRule->getDiscountAmount() }}€</td>
        </tr>
    @endforeach
    <tr>
        <th scope="row">Total Discount</th>
        <td>{{ CartProvider::instance()->getDiscountAmount() }} €</td>
    </tr>
    <tr>
        <th scope="row">Total Tax</th>
        <td>{{ CartProvider::instance()->getTaxAmount() }} €</td>
    </tr>
    <tr>
        <th scope="row">Coste de envío</th>
        <td>{{ CartProvider::instance()->getShippingAmount() }} €</td>
    </tr>
    <tr>
        <th scope="row">Total Without shipping</th>
        <td>{{ CartProvider::instance()->getCartItemsTotal() }} €</td>
    </tr>
    <tr>
        <th scope="row">Total Without shipping and without discounts</th>
        <td>{{ CartProvider::instance()->getCartItemsTotalWithoutDiscounts() }} €</td>
    </tr>
    <tr>
        <th scope="row">Total</th>
        <td>{{ CartProvider::instance()->getTotal() }} €</td>
    </tr>
    </tbody>
</table>
{{--<div class="row">--}}
{{--<div class="col-md-7">--}}
{{--<h4>Coupon name</h4>--}}
{{--</div>--}}
{{--<div class="col-md-5">--}}
{{--<h3>-9999€</h3>--}}
{{--</div>--}}
{{--</div>--}}