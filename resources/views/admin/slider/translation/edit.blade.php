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
                                action="{{ route('sliders.translations.update', [$sliderId, $translation->id]) }}"
                                method="POST" enctype="multipart/form-data">@csrf

                                @method('PUT')

                                <a class="btn btn-block btn-primary"
                                style="max-width:100px; display:inline-block;"
                                href="{{ route('sliders.translations.index',[$sliderId]) }}">Back
                                </a>
                                <br> <br>
                                <h4>Edit Blog Translation Data</h4>
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
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $translation->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="second_title">Second Title</label>
                                    <input type="text" class="form-control" name="second_title"
                                        value="{{ $translation->second_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description"
                                        >{{ $translation->description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
