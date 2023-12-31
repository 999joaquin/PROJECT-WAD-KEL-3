@extends('layouts.layoutUser')
@section('title', 'Doctors List')
@section('content')
<div class="container mt-4">
    <h2>Select a Doctor</h2>

    <div class="list-group">
        @foreach ($doctors as $doctor)
            <a href="{{ route('user.viewDoctorSchedule', $doctor->id) }}" class="list-group-item list-group-item-action">
                Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
            </a>
        @endforeach
    </div>
</div>
@endsection