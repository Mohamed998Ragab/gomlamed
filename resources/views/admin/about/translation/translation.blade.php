@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Translation</h4>
                            <a class="btn btn-block btn-primary"
                                style="max-width:150px; float:right; display:inline-block;"
                                href="{{ route('abouts.translations.create', [$aboutId]) }}">Add About Data
                            </a>
                            <br> <br>
                            <br>
                            <a class="btn btn-block btn-primary"
                            style="max-width:100px; float:right; display:inline-block;"
                            href="{{ url('admin/about') }}">Back
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
                                                Language
                                            </th>
                                            <th>
                                                First Title
                                            </th>
                                            <th>
                                                First Description
                                            </th>
                                            <th>
                                                Second Title
                                            </th>
                                            <th>
                                                Second Description
                                            </th>
                                            <th>
                                                Third Title
                                            </th>
                                            <th>
                                                Third Description
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($translations as $translation)
                                        <tr>
                                            <td>{{ $translation->language->name }}</td>
                                            <td>
                                                <p>{{$translation['first_title']}}</p>
                                             </td>
                                             <td>
                                                 <p>{{$translation['first_description']}}</p>
                                             </td>
                                             <td>
                                                 <p>{{$translation['second_title']}}</p>
                                             </td>
                                             <td>
                                                 <p>{{$translation['second_description']}}</p>
                                             </td>
                                             <td>
                                                 <p>{{$translation['third_title']}}</p>
                                             </td>
                                             <td>
                                                 <p>{{$translation['third_description']}}</p>
                                             </td>

                                            <td>
                                                <a href="{{ route('abouts.translations.edit', [$aboutId, $translation->id]) }}" class="btn  btn-primary">Edit</a>
                                                <form action="{{ route('abouts.translations.destroy', [$aboutId, $translation->id]) }}" method="POST" style="display:inline;">
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
                            <div class="pagination-container">
                                <ul class="pagination">
                                    @if ($translations->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $translations->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    @for ($i = 1; $i <= $translations->lastPage(); $i++)
                                        <li class="page-item {{ $translations->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $translations->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor
                            
                                    @if ($translations->currentPage() < $translations->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $translations->nextPageUrl() }}" class="page-link" aria-label="Next">
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
