@extends('layouts.layoutUser')
@section('title', 'Doctor Schedule')
@section('content')
<div class="container mt-4">
    <h2>Schedule for Dr. {{ $doctor->name }}</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Day</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctor->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
