@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Daftar Rekam Medis</h2>
        <a href="{{ route('rekammedis.create') }}" class="btn btn-primary mb-3">Tambah Rekam Medis</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Umur</th>
                    <th>Tanggal Rekam Medis</th>
                    <th>Diagnosis</th>
                    <th>Catatan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listRekamMedis as $rekamMedis)
                    <tr>
                        <td>{{ $rekamMedis->id }}</td>
                        <td>{{ $rekamMedis->nama_pasien }}</td>
                        <td>{{ $rekamMedis->umur }}</td>
                        <td>{{ $rekamMedis->tanggal_rekammedis }}</td>
                        <td>{{ $rekamMedis->diagnosis }}</td>
                        <td>{{ $rekamMedis->catatan }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Rekam Medis Actions">
                                <a href="{{ route('rekammedis.show', $rekamMedis->id) }}" class="btn btn-info btn-sm rounded mr-2">View</a>
                                <a href="{{ route('rekammedis.edit', $rekamMedis->id) }}" class="btn btn-primary btn-sm rounded mr-2">Edit</a>
                                <form action="{{ route('rekammedis.destroy', $rekamMedis->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada rekam medis yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
