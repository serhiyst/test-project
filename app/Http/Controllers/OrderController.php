<?php

namespace App\Http\Controllers;

use App\Events\OrderSubmited;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::get('https://freegeoip.app/json/'.$request->ip())->json();
        abort_if($response['country_code'] === 'SO', 403, 'Somali not allowed');

        $items = collect($request->get('products'))->filter(function ($count) {
            return $count > 0;
        })->mapWithKeys(function ($count, $productId) {
            return [$productId => ['quantity' => $count]];
        });

        $order = Order::create([]);

        $order->products()->sync($items);

        return redirect()->route('order-created', [
            'order' => $order->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'email' => 'required|email',
            'shipping_address_1' => 'required|string',
            'shipping_address_2' => 'string',
            'shipping_address_3' => 'string',
            'city' => 'required|string',
            'country_code' => 'required|string',
            'zip_postal_code' => 'required|string',
        ]);
        $order->update($request->all());
        event(new OrderSubmited($order));

        return redirect('/products');
    }
}
