<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    function addDoctor(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'specialization' => 'required'
        ]);

        $doctor = Doctor::create([
            'name' => $validateData['name'],
            'specialization' => $validateData['specialization']
        ]);

        if($doctor){
            return redirect()->route('admin.dashboard')->with('success', 'Doctor added successfully');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to add doctor.');
        }
    }

    function showAddDoctorForm(){
        return view('admin.add-doctor');
    }

    function viewDoctors(){
        $doctors = Doctor::all();
        return view('admin.view-doctors', compact('doctors'));
    }

    function viewAppointments(){
        $appointments = Appointment::with('doctor')->get();
        return view('admin.view-appointments', compact('appointments'));
    }

    function editAppointment($id){
        $appointment = Appointment::findOrFail($id);
        return view('admin.edit-appointment', compact('appointment'));
    }

    function updateAppointment(Request $request, $id){
        $validateData = $request->validate([
            'appointment_date' => 'required|date',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($validateData);

        return redirect()->route('admin.viewAppointments')->with('success', 'Appointment updated.');
    }

    function deleteAppointment($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.viewAppointments')->with('success', 'Appointment deleted.');
    }
}
