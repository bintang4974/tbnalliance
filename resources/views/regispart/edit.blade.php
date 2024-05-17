@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('regispart.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('regispart.update', $regispart->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Participant</label>
                        <select name="participant_id" class="form-control">
                            @php
                                $selected = '';
                                if ($errors->any()) {
                                    $selected = old('participant');
                                } else {
                                    $selected = $regispart->participant_id;
                                }
                            @endphp
                            @foreach ($participant as $participant)
                                <option value="{{ $participant->id }}"
                                    {{ $selected == $participant->id ? 'selected' : '' }}>
                                    {{ $participant->name }}</option>
                            @endforeach
                        </select>
                        @error('participant_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">program</label>
                        <select name="program_id" class="form-control">
                            @php
                                $selected = '';
                                if ($errors->any()) {
                                    $selected = old('program');
                                } else {
                                    $selected = $regispart->program_id;
                                }
                            @endphp
                            @foreach ($program as $program)
                                <option value="{{ $program->id }}" {{ $selected == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="{{ $regispart->status }}">{{ $regispart->status }}</option>
                            <option value="confirm">Confirm</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Attendance</label>
                        <select name="attendance" class="form-control">
                            <option value="{{ $regispart->attendance }}">{{ $regispart->attendance }}</option>
                            <option value="Hadir">hadir</option>
                            <option value="tidak">Tidak Hadir</option>
                        </select>
                        @error('attendance')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control">{{ $regispart->notes }}</textarea>
                        @error('notes')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
