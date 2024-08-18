@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Users</h4>

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

                            <div class="table-responsive pt-3">
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>User Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->user_type }}</td>
                                                <td>
                                                    <a class="confirmDelete" href="{{ url('admin/deleteUser/' . $user->id) }}">
                                                        <i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-file-excel-box"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>
                            <h1>Add User</h1>
                            <form class="forms-sample" action="{{ url('admin/addUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required/>
                                    
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required/>
                                    
                                    <label for="mobile">Phone</label>
                                    <input type="text" name="mobile" class="form-control" placeholder="Phone" required/>
                                    
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                                    
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required/>
                                </div>
                            
                                <button type="submit" class="btn btn-primary mr-2 ml-2 mb-2 p-3">Submit</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

