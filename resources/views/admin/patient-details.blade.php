@extends('layouts.layoutAdmin')
@section('title', 'Patient Details')
@section('content')
<div class="container mt-4">
    <h2>Details for {{ $patient->name }}</h2>

    <div>
        <h3>Medical Records</h3>
        @foreach ($patient->details as $detail)
            <div class="d-flex align-items-center">
                <div>
                    <p><strong>Record:</strong> {{ $detail->medical_record }}</p>
                    <p><strong>Disease:</strong> {{ $detail->disease }}</p>
                    <p><strong>Medication:</strong> {{ $detail->medication }}</p>
                </div>
                <form action="{{ route('admin.detail.delete', $detail->id) }}" method="POST" class="ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                </form>
            </div>
            <hr>
        @endforeach
    </div>
</div>
@endsection
