@extends('layouts.layoutAdmin')
@section('title', 'View Schedules')
@section('content')
<div class="container mt-4">
    <h2>Doctor Schedules</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Doctor</th>
                <th scope="col">Day</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->doctor->name }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.editSchedule', $schedule->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.deleteSchedule', $schedule->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
