@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admins</h4>

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
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                        <div class="table-responsive pt-3">
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->user_type }}</td>
                                            <td>
                                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn">
                                                        <i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-file-excel-box"></i>
                                                    </button>
                                                </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (Auth::user()->user_type == 'superadmin')
                            <br><br>
                            <h1>Add Admin</h1>
                            <form class="forms-sample" action="{{ url('admin/addAdmin') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required/>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required/>
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required/>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required/>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ml-2 mb-2 p-3">Submit</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
