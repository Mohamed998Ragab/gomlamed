@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders</h4>
                                <!-- Search Form -->
                                <form action="{{ route('admin.orders.search') }}" method="GET" class="form-inline mb-4">
                                    <input type="text" name="search" class="form-control mr-2" placeholder="Search orders..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                            <div class="table-responsive pt-3">
                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success: </strong>{{ Session::get('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table id="" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Phone</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->user->phone }}</td>
                                                <td>{{ $order->total_price }} EGP</td>
                                                <td>
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                        @csrf
                                                        <select name="status" onchange="this.form.submit()">
                                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Shipping</option>
                                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">View</a>
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="pagination-container">
                                <ul class="pagination">
                                    @if ($orders->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $orders->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                        <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $orders->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor
                            
                                    @if ($orders->currentPage() < $orders->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $orders->nextPageUrl() }}" class="page-link" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
