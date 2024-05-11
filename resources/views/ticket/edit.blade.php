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
                <form action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>No Ticket</label>
                        <input type="text" name="no_ticket" class="form-control" value="{{ $ticket->no_ticket }}">
                        @error('no_ticket')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" name="place" class="form-control" value="{{ $ticket->place }}">
                        @error('place')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $ticket->date }}">
                        @error('date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="{{ $ticket->type }}">{{$ticket->type}}</option>
                            <option value="Berbayar">Berbayar</option>
                            <option value="Gratis">Gratis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Program</label>
                        <select name="program_id" class="form-control">
                            @php
                                $selected = '';
                                if ($errors->any()) {
                                    $selected = old('program');
                                } else {
                                    $selected = $ticket->program_id;
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

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
