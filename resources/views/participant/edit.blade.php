@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('participant.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('participant.update', $participant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $participant->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $participant->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="number" name="telp" class="form-control" value="{{ $participant->telp }}">
                        @error('telp')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control">{{ $participant->notes }}</textarea>
                        @error('notes')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Afiliate</label>
                        <input type="text" name="afiliate" class="form-control" value="{{ $participant->afiliate }}">
                        @error('afiliate')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ticket</label>
                        <select name="ticket_id" class="form-control">
                            @php
                                $selected = '';
                                if ($errors->any()) {
                                    $selected = old('ticket');
                                } else {
                                    $selected = $participant->ticket_id;
                                }
                            @endphp
                            @foreach ($ticket as $ticket)
                                <option value="{{ $ticket->id }}" {{ $selected == $ticket->id ? 'selected' : '' }}>
                                    {{ $ticket->no_ticket }}</option>
                            @endforeach
                        </select>
                        @error('ticket_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
