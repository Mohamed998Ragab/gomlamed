@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Contact Us</h4>
                            
                            @if (Session::has('success'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success: </strong>{{Session::get('success')}}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
              
                            @endif
                            <div class="table-responsive pt-4">
                                
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Phone
                                            </th>
                                            <th>
                                                Message
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>
                                                    {{ $contact['name'] }}
                                                </td>
                                                <td>
                                                    {{ $contact['email'] }}
                                                </td>
                                                <td>
                                                    {{ $contact['phone'] }}
                                                </td>
                                                <td>
                                                    <p>{{ $contact['message'] }}</p>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.contacts.destroy', [$contact->id]) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn  btn-primary">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

