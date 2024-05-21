@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('experience.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Desc</th>
                            <th>Picture</th>
                            <th>Participant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($experience as $experience)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $experience->desc }}</td>
                                <td><img src="{{ asset('images/' . $experience->picture) }}" height="50" width="50"></td>
                                <td>{{ $experience->participant->name }}</td>
                                <td>
                                    <a href="{{ route('experience.edit', $experience->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('experience.destroy', $experience->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus experience ini?')"><i class="fas fa-trash"></i></button>
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
