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
    @if(isset($delete) && $delete)
        <div class="col-md-1">
            <p>{{ trans('common.delete') }}</p>
        </div>
    @endIf
</div>