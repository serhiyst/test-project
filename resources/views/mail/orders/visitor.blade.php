@component('mail::message')

    # New order created

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
