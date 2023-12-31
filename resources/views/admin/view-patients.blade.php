@extends(layouts.layoutAdmin)
@section('title', 'Liat Pasien')
@section('content')
@extends('layouts.layoutAdmin')

@section('title', 'View Patients')

@section('content')
<div class="container mt-4">
    <h2>Daftar Pasien</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">NIM</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Nomor HP</th>
                <th scope="col">Alamat</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <th scope="row">{{ $patient->id }}</th>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->nim }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                            
                            <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@endsection