@extends('layouts.layoutAdmin')
@section('title', 'View Doctors')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header font-weight-bold bg-primary text-white">Doctor List</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Specialization</th>
                                    <th>Education</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->id }}</td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->specialization }}</td>
                                        <td>{{ $doctor->education }}</td>
                                        <td>
                                            @if($doctor->image != 'noimage.jpg')
                                                <img src="{{ asset('storage/images/'.$doctor->image) }}" class="img-fluid img-thumbnail" alt="Doctor Image" style="max-width: 100px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.editDoctor', $doctor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.deleteDoctor', $doctor->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 15px;
        }
        .card-header {
            font-size: 1.25rem;
        }
        .table-hover tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
@endsection
