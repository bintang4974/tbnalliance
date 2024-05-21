@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('experience.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('experience.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Desc</label>
                        <textarea name="desc" class="form-control">{{ $experience->desc }}</textarea>
                        @error('desc')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Picture</label>
                        <input type="file" name="picture" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">participant</label>
                        <select name="participant_id" class="form-control">
                            @php
                                $selected = '';
                                if ($errors->any()) {
                                    $selected = old('participant');
                                } else {
                                    $selected = $experience->participant_id;
                                }
                            @endphp
                            @foreach ($participant as $participant)
                                <option value="{{ $participant->id }}" {{ $selected == $participant->id ? 'selected' : '' }}>
                                    {{ $participant->name }}</option>
                            @endforeach
                        </select>
                        @error('participant_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
