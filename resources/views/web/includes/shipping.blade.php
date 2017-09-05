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
        @empty(! $shippingData->get('territorial_area_1'))
            <tr>
                <th scope="row">{{ $shippingData->get('country')->territorial_area_1 }}</th>
                <td> {{ $shippingData->get('territorial_area_1')->name }}</td>
            </tr>
        @endempty
        @empty(! $shippingData->get('territorial_area_2'))
            <tr>
                <th scope="row">{{ $shippingData->get('country')->territorial_area_2 }}</th>
                <td> {{ $shippingData->get('territorial_area_2')->name }}</td>
            </tr>
        @endempty
        <tr>
            <th scope="row">CP</th>
            <td>{{ $shippingData->get('cp') }}</td>
        </tr>
        <tr>
            <th scope="row">Address</th>
            <td>{{ $shippingData->get('address') }}</td>
        </tr>
        <tr>
            <th scope="row">Comments</th>
            <td>{{ $shippingData->get('comments') }}</td>
        </tr>
        <tr>
            <th scope="row">Price</th>
            <td>{{ CartProvider::instance()->getShippingAmount() }} €</td>
        </tr>
        </tbody>
    </table>
@endif