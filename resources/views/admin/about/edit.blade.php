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
                <strong>Error: </strong>{{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @endif
              
              @if (Session::has('success_message'))

              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong>{{Session::get('success_message')}}
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

              <form class="forms-sample" 
              action="{{url('admin/about/'.$about['id'])}}"
                 method="POST" enctype="multipart/form-data">@csrf
                 
                 <a class="btn btn-block btn-primary"
                 style="max-width:100px; display:inline-block;"
                 href="{{ url('admin/about') }}">Back
                 </a>
                 <br> <br>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" name="image" class="form-control" id="image" required />
                  <br>
                  <img src="{{ asset($about['image']) }}" style="width: 320px; height:220px;" />
                  <br> <br>
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