@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form id="form" method="POST" action="/orders/{{ $order->id }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Shipping address 1</label>
                    <input type="text" name="shipping_address_1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Shipping address 2</label>
                    <input type="text" name="shipping_address_2" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Shipping address 3</label>
                    <input type="text" name="shipping_address_3" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" name="city" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Country code</label>
                    <input type="text" name="country_code" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Zip postal code</label>
                    <input type="text" name="zip_postal_code" required>
                </div>
                <button class="btn-info" type="submit" form="form">Submit</button>
            </form>
        </div>
    </div>
@endsection
