<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class UserController extends Controller
{
    function dashboard(){
        return view('user.dashboard');
    }

    function createAppointment(Request $request) {
        $validatedData = $request->validate([
            'specialization' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'keluhan' => 'required',
        ]);

        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Please log in first before creating an appointment.');
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

        return redirect()->route('user.dashboard')->with('success', 'Appointment created successfully.');
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

    function viewBerita(){
        //
    }

}

