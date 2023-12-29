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

    function addSchedule(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'doctor_id' => 'required',
            'hari' => 'required',
            'schedule_start' => 'required',
            'schedule_end' => 'required',
            'specialization' => 'required'
        ]);

        $schedule = Schedule::create([
            'name' => $validateData['name'],
            'doctor_id' => $validateData['doctor_id'],
            'hari' => $validateData['hari'],
            'specialization' => $validateData['specialization'],
            'schedule_start' => $validateData['schedule_start'],
            'schedule_end' => $validateData['schedule_end'],
        ]);

        if($schedule){
            return redirect()->route('admin.dashboard')->with('success', 'Schedule added successfully');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to add schedule.');
        }
        
    }

    function showAddScheduleForm(Request $request){
        $schedules = Schedule::all();
        return view('admin.showAddScheduleForm');
    }
}
