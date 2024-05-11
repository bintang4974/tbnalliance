@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('ticket.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>No Ticket</label>
                        <input type="text" name="no_ticket" class="form-control">
                        @error('no_ticket')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" name="place" class="form-control">
                        @error('place')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                        @error('date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option>-- Select One --</option>
                            <option value="Berbayar">Berbayar</option>
                            <option value="Gratis">Gratis</option>
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
                        {{-- <select name="program_id" class="form-control">
                            @foreach ($program as $program)
                                <option value="{{ $program->id }}" {{ old('program') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}</option>
                            @endforeach
                        </select> --}}
                        @error('program_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
