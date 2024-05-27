@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('page.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Title</th>
                            <th>Desc</th>
                            <th>About</th>
                            <th>Mission</th>
                            <th>Choose</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($page as $page)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->desc }}</td>
                                <td>{{ $page->about }}</td>
                                <td>{{ $page->mission }}</td>
                                <td><a href="{{ url('page/'.$page->id.'/upload') }}" class="btn btn-primary btn-sm"><i class="fas fa-images"></i> Add</a></td>
                                {{-- <td><a href="{{ route('page.upload', $page->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-images"></i> Add</a></td> --}}
                                <td>
                                    <a href="{{ route('page.edit', $page->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('page.destroy', $page->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus page ini?')"><i class="fas fa-trash"></i></button>
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
