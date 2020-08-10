@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form id="form" method="POST" action="/orders">
                @csrf
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ $product->image_url }}"></td>
                                <td><input type="text" name="products[{{ $product->id }}]" value="0"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn-info" type="submit" form="form">Submit</button>
            </form>
        </div>
    </div>
@endsection
