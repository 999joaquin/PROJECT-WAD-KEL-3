@extends('layouts.layoutUser')
@section('title', 'Create Appointment')
@section('content')
    <h1 class="container-fluid" style="width: 500px">Create Appointment</h1>
    
    <form action="{{ route('user.createAppointment') }}" method="POST" class="container-fluid" style="width: 500px">
        @csrf
        <div class="form-group">
            <label for="specialization">Specialization:</label>
            <select name="specialization" id="specialization" class="form-control" onchange="filterDoctors()">
                <option value="" disabled selected>Select Specialization</option>
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization }}">{{ $specialization }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                <option value="" disabled selected>Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option class="doctor-option" value="{{ $doctor->id }}" data-specialization="{{ $doctor->specialization }}" style="display: none;">
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="appointment_time">Appointment Time:</label>
            <input type="time" id="appointment_time" name="appointment_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="issues">Health Issues/Concerns:</label>
            <textarea id="keluhan" name="keluhan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary container-fluid">Create Appointment</button>
    </form>

    <!-- Script buat filtering dokter yang muncul pada saat pemilihan specialization-->
    <script>
        function filterDoctors() {
            var specialization = document.getElementById('specialization').value;
            var doctorOptions = document.getElementsByClassName('doctor-option');

            for (var i = 0; i < doctorOptions.length; i++) {
                if (doctorOptions[i].getAttribute('data-specialization') === specialization) {
                    doctorOptions[i].style.display = 'block';
                } else {
                    doctorOptions[i].style.display = 'none';
                }
            }
        }
    </script>
@endsection
