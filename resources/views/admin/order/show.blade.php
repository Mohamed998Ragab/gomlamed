@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order Details</h4>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Total Price</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ ucfirst($order->status) }}</td>
                                            <td>${{ $order->total_price }} EGP</td>
                                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4 class="card-title mt-4">Order Items</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            @php
                                                $translation = $item->product->translation(app()->getLocale());
                                            @endphp
                                            <tr>
                                                <td>{{ $translation->title }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>${{ $item->quantity * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">Back to Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
