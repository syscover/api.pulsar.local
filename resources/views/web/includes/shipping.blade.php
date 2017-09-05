@if(CartProvider::instance()->hasItemTransportable())
    <h3 class="margin-vertical-20">Shipping data</h3>
    <table class="table">
        <tbody>
        <tr>
            <th scope="row">Name</th>
            <td>{{ $shipping->get('name') }}</td>
        </tr>
        <tr>
            <th scope="row">Surname</th>
            <td>{{ $shipping->get('surname') }}</td>
        </tr>
        <tr>
            <th scope="row">Country</th>
            <td>{{ $shipping->get('country')->name }}</td>
        </tr>
        @empty(! $shipping->get('territorial_area_1'))
            <tr>
                <th scope="row">{{ $shipping->get('country')->territorial_area_1 }}</th>
                <td> {{ $shipping->get('territorial_area_1')->name }}</td>
            </tr>
        @endempty
        @empty(! $shipping->get('territorial_area_2'))
            <tr>
                <th scope="row">{{ $shipping->get('country')->territorial_area_2 }}</th>
                <td> {{ $shipping->get('territorial_area_2')->name }}</td>
            </tr>
        @endempty
        <tr>
            <th scope="row">CP</th>
            <td>{{ $shipping->get('cp') }}</td>
        </tr>
        <tr>
            <th scope="row">Address</th>
            <td>{{ $shipping->get('address') }}</td>
        </tr>
        <tr>
            <th scope="row">Comments</th>
            <td>{{ $shipping->get('comments') }}</td>
        </tr>
        <tr>
            <th scope="row">Price</th>
            <td>{{ CartProvider::instance()->getShippingAmount() }} €</td>
        </tr>
        </tbody>
    </table>
@endif