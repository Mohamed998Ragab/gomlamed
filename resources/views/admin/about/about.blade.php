@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About</h4>
                            <a class="btn btn-block btn-primary"
                                style="max-width:150px; float:right; display:inline-block;"
                                href="{{url('admin/addAbout')}}">Add About Data
                            </a>
                            
                            @if (Session::has('success_message'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success: </strong>{{Session::get('success_message')}}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
              
                            @endif
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                            <th>
                                                Translation
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($abouts as $about) --}}
                                        <tr>

                                            <td>
                                                @if(!empty($about->image))
                                                <img src="{{asset($about->image) }}"  style="border-radius: 10px; width:250px; height:200px; object-fit:contain; ">
                                                @else
                                                <div style="display: none !important;">
                                                </div>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{url('admin/about/'.$about->id)}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-pencil-box"></i></a>

                                                <a  class="confirmDelete" href="{{url('admin/deleteAbout/'.$about->id)}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-file-excel-box"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-block btn-primary"
                                                style="max-width:120px; display:inline-block; "
                                                href="{{ route('abouts.translations.index', [$about->id]) }}">
                                                Translation
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- @endforeach --}}
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
