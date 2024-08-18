@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>


                            @if (Session::has('error_message'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong>{{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong>{{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="forms-sample" action="{{ url('admin/product/' . $product['id']) }}" method="POST"
                                enctype="multipart/form-data">@csrf
                                <a class="btn btn-block btn-primary"
                                style="max-width:100px; display:inline-block;"
                                href="{{ url('admin/product') }}">Back
                                </a>
                                <br> <br>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control" />
                                    <br>
                                    <img src="{{ asset($product['image']) }}" style="width: 320px; height:220px;" />
                                    <br> <br>

                                    <label for="price">Price</label>
                                    <input name="price" class="form-control" id="price"
                                        value="{{ old('date', $product->price) }}" />

                                    <label for="discount">Discount</label>
                                    <input name="discount" class="form-control" id="discount"
                                        value="{{ old('date', $product->discount) }}" />
                                        
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->translation()->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 ml-2 mb-2 p-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
