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

                            <form class="forms-sample"
                                action="{{ route('abouts.translations.update', [$aboutId, $translation->id]) }}"
                                method="POST" enctype="multipart/form-data">@csrf

                                @method('PUT')

                                <a class="btn btn-block btn-primary"
                                style="max-width:100px; display:inline-block;"
                                href="{{ route('abouts.translations.index',[$aboutId]) }}">Back
                                </a>
                                <br> <br>
                                <h4>Edit About Translation Data</h4>
                                <div class="form-group">
                                    <label for="language_id">Language</label>
                                    <select class="form-control" name="language_id">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                {{ $language->id == $translation->language_id ? 'selected' : '' }}>
                                                {{ $language->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="first_title">First Title</label>
                                    <input type="text" class="form-control" name="first_title" value="{{ $translation->first_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="first_description">First Description</label>
                                    <textarea type="text" class="form-control" name="first_description">{{ $translation->first_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="second_title">Second Title</label>
                                    <input type="text" class="form-control" name="second_title" value="{{ $translation->second_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="second_description">Second Description</label>
                                    <textarea type="text" class="form-control" name="second_description">{{ $translation->second_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="third_title">Third Title</label>
                                    <input type="text" class="form-control" name="third_title" value="{{ $translation->third_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="third_description">Third Description</label>
                                    <textarea type="text" class="form-control" name="third_description">{{ $translation->third_description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
