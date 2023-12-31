@extends('layouts.layoutAdmin')
@section('title', 'Add Medical Record')
@section('content')
<div class="container mt-4">
    <h2>Add Medical Record for {{ $patient->name }}</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.details.store', $patient->id) }}">
        @csrf
        <div class="mb-3">
            <label for="medical_record" class="form-label">Medical Record</label>
            <textarea class="form-control" id="medical_record" name="medical_record" required></textarea>
        </div>
        <div class="mb-3">
            <label for="disease" class="form-label">Disease</label>
            <input type="text" class="form-control" id="disease" name="disease" required>
        </div>
        <div class="mb-3">
            <label for="medication" class="form-label">Medication</label>
            <input type="text" class="form-control" id="medication" name="medication" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Record</button>
    </form>
</div>
@endsection
