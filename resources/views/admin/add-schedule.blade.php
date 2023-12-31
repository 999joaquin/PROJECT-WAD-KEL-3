@extends('layouts.layoutAdmin')
@section('title', 'Add Doctor Schedule')
@section('content')
<div class="container mt-4">
    <h2>Add Doctor Schedule</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.addSchedule') }}">
        @csrf

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor</label>
            <select class="form-control" id="doctor_id" name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <input type="text" class="form-control" id="day" name="day" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Schedule</button>
    </form>
</div>
@endsection
