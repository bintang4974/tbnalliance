@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('page.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <h5>Page Title : {{ $page->title }}</h5>
                <hr>

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ url('page/' . $page->id . '/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="image[]" multiple class="form-control">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>

                <hr>

                @foreach ($chooseImage as $chooseIm)
                    <img src="{{ asset($chooseIm->image) }}" width="100px" height="100px" class="border p-2 m-3">

                    <a href="{{ url('choose-image/' . $chooseIm->id . '/delete') }}" class="btn btn-sm btn-danger">Delete</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
