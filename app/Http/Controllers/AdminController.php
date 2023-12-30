<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Medicin;

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

    function showMedicine(){
        $obato = Medicin::all();
        return view('admin.view-medicine', compact('obato'));
    }

    function detailMedicine(Medicin $id){
        $obato = Medicin::find($id);
        return view('admin.detail-medicine', ['id' => $id], compact('obato'));
    }

    function addMedicines(){
        return view('admin.add-medicine');
    }

    function addMedicine(Request $request){
        
        $validateData = $request->validate([
            'nama_obat' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'efek_samping' => 'required',
            'golongan' => 'required',
            'noregis' => 'required',
            'stock' => 'required'
        ]);

        // dd($validateData);
        $obatu = Medicin::create([
            'nama_obat' => $validateData['nama_obat'],
            'harga' => $validateData['harga'],
            'deskripsi' => $validateData['deskripsi'],
            'efek_samping' => $validateData['efek_samping'],
            'golongan' => $validateData['golongan'],
            'noregis' => $validateData['noregis'],
            'stock' => $validateData['stock']
        ]);

        if($obatu){
            return redirect()->route('admin.showMedicine')->with('success', 'Medicine added successfully');
        } else {
            return redirect()->route('admin.showMedicine')->with('error', 'Failed to add Medicine.');
        }
    }

    function updateMedicine(Request $request, $id){
        $data = Medicin::find($id);
        $validateData = $request->validate([
            'nama_obat' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'efek_samping' => 'required',
            'golongan' => 'required',
            'noregis' => 'required',
            'stock' => 'required'
        ]);

        $dat = Medicin::find($id);
        $obato = Medicin::all();
        $dat->update($validateData);
        $dat->save();

        return redirect()->route('admin.showMedicine')->with('success', 'Medicine update successfully');
    }

    function editMedicines(Medicin $id){
        $obat = Medicin::find($id);
        return view('admin.edit-medicine', ['id' => $id], compact('obat'));
    }

    function deleteMedicine($id){
        $obat = Medicin::findOrFail($id);
        $obat->delete();
        return redirect()->route('admin.showMedicine', compact('obat'))->with('success', 'Medicine deleted successfully');

    }
}
