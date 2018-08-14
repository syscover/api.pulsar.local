@foreach($cartItems as $item)
    <div class="row row-cart">
        <div class="col-md-1">
            <img {!! get_src_srcset_alt_title($item->options->product->attachments->first()) !!} class="img-fluid">
        </div>
        <div class="col-md-2">
            <p>{{ $item->name }}</p>
        </div>
        <div class="col-md-1">
            <p>{{ $item->getPrice() }} € / unit</p>
        </div>
        <div class="col-md-1">
            <p>{{ $item->getQuantity() }}</p>
            @if(isset($quantity) && $quantity)
                <input type="hidden" name="{{ $item->rowId }}" value="{{ $item->getQuantity() }}">
                <a href="#" class="increase"><i class="fas fa-plus"></i></a>
                <a href="#" class="decrease"><i class="fas fa-minus"></i></a>
            @endif
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
        @if(isset($delete) && $delete)
            <div class="col-md-1">
                <a href="{{ route('web.delete_shopping_cart-' . user_lang(), ['rowId' => $item->rowId]) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        @endif
    </div>
@endforeach