@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>All User Carts</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if($carts->isEmpty())
        <p>No carts available.</p>
    @else
        @foreach($carts as $userId => $userCarts)
            @php
                $user = $userCarts->first()->user;
            @endphp
            <h2>Cart for {{ $user->name }} ({{ $user->email }})</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userCarts as $item)
                        @php
                            $translation = $item->product->translation($selectedLanguage);
                        @endphp
                        <tr>
                            <td>{{ $translation->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="cart__total">
                <h6>Cart total for {{ $user->name }}</h6>
                <ul>
                    <li>Total <span>${{ $userCarts->sum(function($item) { return $item->product->price * $item->quantity; }) }}</span></li>
                </ul>
            </div>
        @endforeach
    @endif
</div>
@endsection
