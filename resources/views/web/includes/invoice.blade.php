@if(CartProvider::instance()->hasInvoice())
    <h3>Invoice </h3>
    <table class="table">
        <tbody>
        <tr>
            <th scope="row">Company</th>
            <td>{{ $invoice->get('company') }}</td>
        </tr>
        <tr>
            <th scope="row">TIN</th>
            <td>{{ $invoice->get('tin') }}</td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td>{{ $invoice->get('name') }}</td>
        </tr>
        <tr>
            <th scope="row">Surname</th>
            <td>{{ $invoice->get('surname') }}</td>
        </tr>
        <tr>
            <th scope="row">Country</th>
            <td>{{ $invoice->get('country')->name }}</td>
        </tr>
        @empty(! $invoice->has('territorial_area_1'))
            <tr>
                <th scope="row">{{ $invoice->get('country')->territorial_area_1 }}</th>
                <td> {{ $invoice->get('territorial_area_1')->name }}</td>
            </tr>
        @endempty
        @empty(! $invoice->has('territorial_area_2'))
            <tr>
                <th scope="row">{{ $invoice->get('country')->territorial_area_2 }}</th>
                <td> {{ $invoice->get('territorial_area_2')->name }}</td>
            </tr>
        @endempty
        <tr>
            <th scope="row">CP</th>
            <td>{{ $invoice->get('cp') }}</td>
        </tr>
        <tr>
            <th scope="row">Address</th>
            <td>{{ $invoice->get('address') }}</td>
        </tr>
        <tr>
            <th scope="row">Comments</th>
            <td>{{ $invoice->get('comments') }}</td>
        </tr>
        <tr>
            <th scope="row">Price</th>
            <td>{{ CartProvider::instance()->getShippingAmount() }} €</td>
        </tr>
        </tbody>
    </table>
@endif