@extends('layouts.layoutAdmin')
@section('title', 'Edit Appointment')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Edit Janji Temu</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updateAppointment', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="appointment_date">Tanggal Janji Temu:</label>
                        <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Waktu Janji Temu:</label>
                        <input type="time" id="appointment_time" name="appointment_time" class="form-control" value="{{ $appointment->appointment_time }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Janji Temu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
