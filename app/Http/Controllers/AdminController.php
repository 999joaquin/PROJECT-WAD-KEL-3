<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Patient;


class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    public function viewPatients(){ // Joaquin
        $patients = Patient::all();
        return view('admin.view-patients');
    }

    public function editPatients(Patient $patient){ // Joaquin
        return view('admin.edit-patients', compact('patient'));
    }

    public function updatePatients(Request $request, Patient $patient){ // Joaquin
        $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:12',
            'address' => 'required|string'
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.dashboard')->with('success', 'Data pasien telah berhasil di update');

    }

    function destroyPatients(Patient $patient){ // Joaquin
        $patient->delete();
        return redirect()->route('admin.patients.dashboard')->with('success', 'Data pasien berhasil dihapus');
    }

    //niluh
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

        return redirect()->route('admin.viewAppointments')->with('success', 'Janji temu telah berhasil diupdate');
    }

    function deleteAppointment($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.viewAppointments')->with('success', 'Janji tem berhasil dihapus');
    }
    //
}
