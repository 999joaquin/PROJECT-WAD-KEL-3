@extends('layouts.layoutAdmin')
@section('title', 'View Appointments')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Janji Temu</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Spesialisasi</th>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Issue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->doctor->specialization }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->keluhan }}</td>
                                <td>
                                    <a href="{{ route('admin.editAppointment', $appointment->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('admin.deleteAppointment', $appointment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($appointments->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Janji Temu Tidak Ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
