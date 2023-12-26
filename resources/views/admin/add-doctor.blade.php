@extends('layouts.layoutAdmin')
@section('title', 'Add Doctor')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Add Doctor</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.addDoctor') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Doctor's Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="specialization">Specialization:</label>
                        <input type="text" id="specialization" name="specialization" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Doctor</button>
                </form>
            </div>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.viewDoctors') }}" class="btn btn-secondary mb-3">View Doctors</a> 
        </div>
    </div>
@endsection
