@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">First Banner</h4>
                            <a class="btn btn-block btn-primary"
                                style="max-width:150px; float:right; display:inline-block;"
                                href="{{url('admin/addFirstBanner')}}">Add Banner Data
                            </a>
                            
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
                                                ID
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
                                        @foreach($banners as $banner)
                                        <tr>
                                            <td>
                                                {{ $banner->id }}
                                            </td>
                                            <td>
                                                {{-- <a href="{{url('admin/firstBanner/'.$banner['id'])}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-pencil-box"></i></a> --}}
                                                <a  class="confirmDelete" href="{{url('admin/deleteFirstBanner/'.$banner['id'])}}"><i style="font-size: 25px; color:#532e00 !important" class="mdi mdi-file-excel-box"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-block btn-primary"
                                                style="max-width:120px; display:inline-block; "
                                                href="{{ route('firstBanners.translations.index', [$banner->id]) }}">
                                                Translation
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-container">
                                <ul class="pagination">
                                    @if ($banners->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $banners->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    @for ($i = 1; $i <= $banners->lastPage(); $i++)
                                        <li class="page-item {{ $banners->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $banners->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor
                            
                                    @if ($banners->currentPage() < $banners->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $banners->nextPageUrl() }}" class="page-link" aria-label="Next">
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
