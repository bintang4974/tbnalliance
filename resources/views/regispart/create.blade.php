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
                <form action="{{ route('regispart.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Participant</label>
                        <select name="participant_id" class="form-control">
                            <option>-- Select One --</option>
                            @foreach ($participant as $participant)
                                <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Program</label>
                        <select name="program_id" class="form-control">
                            <option>-- Select One --</option>
                            @foreach ($program as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option>-- Select One --</option>
                            <option value="confirm">Confirm</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Attendance</label>
                        <select name="attendance" class="form-control">
                            <option>-- Select One --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="tidak">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
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
