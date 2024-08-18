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

                        <form class="forms-sample" action="{{ route('products.translations.store', $productId) }}"
                            method="POST" enctype="multipart/form-data">@csrf

                            <a class="btn btn-block btn-primary"
                            style="max-width:100px; display:inline-block;"
                            href="{{ route('products.translations.index',[$productId]) }}">Back
                            </a>
                            <br> <br>
                            <h4>Add Product Translation Data</h4>

                            <div class="form-group">
                              <label for="language_id">Language</label>
                              <select class="form-control" name="language_id" required>
                                  @foreach ($languages as $language)
                                      <option value="{{ $language->id }}">{{ $language->name }}</option>
                                  @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" name="description" required></textarea>
                            </div>

                          <button type="submit" class="btn btn-primary">Submit</button>
                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
