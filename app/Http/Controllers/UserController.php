<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

class UserController extends Controller
{
    function dashboard(){
        return view('user.dashboard');
    }

    function listDoctors(){
        $doctors = Doctor::all();
        return view('user.list-doctors', compact('doctors'));
    }

    function viewDoctorSchedule($doctorId){
        $doctor = Doctor::with('schedules')->findOrFail($doctorId);
        return view('user.view-schedule', compact('doctor'));

    function showRegistrationForm(){ // Joaquin
        $user = auth()->user();
        return view('user.register-patient', compact('user'));
    }

    function storeRegistration(Request $request){ // Joaquin
        $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:12',
            'address' => 'required|string'
        ]);

        $user = auth()->user();

        Patient::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'nim' => $user->nim,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Patients telah berhasil ditambahkan');
    }

    //niluh
    function createAppointment(Request $request) {
        $validatedData = $request->validate([
            'specialization' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'keluhan' => 'required',
        ]);

        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Harus login terlebih dahulu sebelum membuat janji temu');
        }

        $appointment = new Appointment([
            'user_id' => Auth::id(),
            'patient_name' => Auth::user()->name,
            'nim' => Auth::user()->nim,
            'doctor_id' => $validatedData['doctor_id'],
            'appointment_date' => $validatedData['appointment_date'],
            'appointment_time' => $validatedData['appointment_time'],
            'keluhan' => $validatedData['keluhan'],
        ]);

        $appointment->save();

        return redirect()->route('user.dashboard')->with('success', 'Janji temu berhasil dibuat');
    }

    function showAppointmentForm() {
        $specializations = Doctor::distinct()->pluck('specialization');
        $doctors = Doctor::all();
        return view('user.create-appointment', compact('specializations', 'doctors'));
    }

    function handleSpecialization(Request $request) {
        $specialization = $request->input('specialization');
        $doctors = Doctor::where('specialization', $specialization)->get();

        return redirect()->route('user.showAppointmentForm')
                         ->with('selectedSpecialization', $specialization)
                         ->with('doctors', $doctors);
    }
    //
}
