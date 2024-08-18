@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product</h4>
                            <a class="btn btn-block btn-primary"
                                style="max-width:150px; float:right; display:inline-block;"
                                href="{{url('admin/addProduct')}}">Add Product Data
                            </a>

                        <!-- Search Form -->
                        <form action="{{ route('admin.product.search') }}" method="GET" class="form-inline mb-4">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search products..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                            
                            <div class="table-responsive pt-3">
                                @if (Session::has('success'))

                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>Success: </strong>{{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                  
                                @endif
                                <table id="" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Category
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Discount
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                            <th>
                                                Translation
                                            </th>
                                            <th>
                                                Top Product
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                @if(!empty($product['image']))
                                                <img class="lozad" src="{{ asset($product['image']) }}" style="width:200px; height:200px; border-radius:10px;" />
                                                @else
                                                <div>
                                                    no image
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{$product->category->englishTranslation->name}}
                                            </td>
                                            <td>
                                                {{$product['price']}}
                                            </td>
                                            <td>
                                                {{$product['discount']}}
                                            </td>
                                            <td>
                                                <a href="{{url('admin/product/'.$product['id'])}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-pencil-box"></i></a>

                                                <a  class="confirmDelete" href="{{url('admin/deleteProduct/'.$product['id'])}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-file-excel-box"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-block btn-primary"
                                                style="max-width:120px; display:inline-block; "
                                                href="{{ route('products.translations.index', [$product->id]) }}">
                                                Translation
                                                </a>
                                            </td>
                                            <td>
                                                <!-- Top Product Button -->
                                                <form action="{{ route('admin.product.toggleTopProduct', $product->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('POST')
                                                    @if($product->isTopProduct)
                                                        <button type="submit" class="btn btn-secondary">Remove from Top Products</button>
                                                    @else
                                                        <button type="submit" class="btn btn-primary">Add to Top Products</button>
                                                    @endif
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
                                    @if ($products->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $products->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor
                            
                                    @if ($products->currentPage() < $products->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $products->nextPageUrl() }}" class="page-link" aria-label="Next">
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
