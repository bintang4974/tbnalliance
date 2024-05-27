@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('program.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $program->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Desc</label>
                        <textarea name="desc" class="form-control">{{ $program->desc }}</textarea>
                        @error('desc')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="date" name="time" class="form-control" value="{{ $program->time }}">
                        @error('time')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" name="place" class="form-control" value="{{ $program->place }}">
                        @error('place')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Speaker</label>
                        <input type="text" name="speaker" class="form-control" value="{{ $program->speaker }}">
                        @error('speaker')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Poster</label>
                        <input type="file" name="poster" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
