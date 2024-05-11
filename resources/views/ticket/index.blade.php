@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('ticket.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>No Ticket</th>
                            <th>Place</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Program</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($ticket as $ticket)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $ticket->no_ticket }}</td>
                                <td>{{ $ticket->place }}</td>
                                <td>{{ $ticket->date }}</td>
                                <td>{{ $ticket->type }}</td>
                                <td>{{ $ticket->program->name }}</td>
                                <td>
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ticket ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
