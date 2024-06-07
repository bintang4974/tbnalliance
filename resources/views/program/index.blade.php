@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('program.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Desc</th>
                            <th>Time</th>
                            <th>Place</th>
                            <th>Speaker</th>
                            <th>Poster</th>
                            <th>Position</th>
                            <th>Hotel Name</th>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Photo Speaker</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($program as $program)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->desc }}</td>
                                <td>{{ $program->time }}</td>
                                <td>{{ $program->place }}</td>
                                <td>{{ $program->speaker }}</td>
                                <td><img src="{{ asset('images/' . $program->poster) }}" height="50" width="50"></td>
                                <td>{{ $program->position }}</td>
                                <td>{{ $program->hotel_name }}</td>
                                <td>{{ $program->ticket_type }}</td>
                                <td>{{ $program->price }}</td>
                                <td><img src="{{ asset('images/' . $program->photo_speaker) }}" height="50" width="50"></td>
                                <td>
                                    <a href="{{ route('program.edit', $program->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('program.destroy', $program->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')"><i class="fas fa-trash"></i></button>
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
