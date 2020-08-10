@component('mail::message')

    # New order created

    ## Visitor

    > {{ $order->email }} <

    > {{ $order->shipping_address_1 }} <
    > {{ $order->shipping_address_2 }} <
    > {{ $order->shipping_address_3 }} <
    > {{ $order->city }} <
    > {{ $order->country_code }} <
    > {{ $order->zip_postal_code }} <

    > Order list

    @foreach($order->products as $product)
        <li>{{ $product->name }}: {{ $product->pivot->quantity }}</li>
    @endforeach


    @component('mail::button', ['url' => '/orders/'.$order->id])
        Details
    @endcomponent

    <br>
    {{ config('app.name') }}
@endcomponent
