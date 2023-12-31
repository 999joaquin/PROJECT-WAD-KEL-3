<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Patient;



class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    function addSchedule(Request $request){ 
        $validateData = $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);
        
        Schedule::create($validateData);

        return redirect()->route('admin.viewSchedules')->with('success', 'Schedule added successfully.');
        
    }

    function showAddScheduleForm(Request $request){
        $doctors = Doctor::all();
        return view ('admin.add-schedule', compact('doctors'));
    }

    function viewSchedules(){
        $schedules = Schedule::with('doctor')->get();
        return view('admin.view-schedules', compact('schedules'));
    }

    function editSchedule($scheduleId){
        $schedule = Schedule::findOrFail($scheduleId);
        $doctors =  Doctor::all();
        return view('admin.edit-schedule', compact('schedule', 'doctors'));
    }

    function updateSchedule(Request $request, $scheduleId){
        $validateData = $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

    $schedule = Schedule::findOrFail($scheduleId);
    $schedule->update($validateData);

    return redirect()->route('admin.viewSchedules')->with('success', 'Schedule updated successfully.');
}
    function deleteSchedule($scheduleId){
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->delete();

        return redirect()->route('admin.viewSchedules')->with('success', 'Schedule deleted successfully.');
      
    function addDoctor(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'education' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $fileNameToStore = 'noimage.jpg';

        if ($request->hasFile('image')) {

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }

        try {
            $doctor = Doctor::create([
                'name' => $validateData['name'],
                'specialization' => $validateData['specialization'],
                'education' => $validateData['education'],
                'image' => $fileNameToStore
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Doctor added successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
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

    function editDoctor($id){
        $doctor = Doctor::findOrFail($id);
        return view('admin.edit-doctor', compact('doctor'));
    }

    function updateDoctor(Request $request, $id){
        $validateData = $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'education' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $doctor = Doctor::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($doctor->image && $doctor->image != 'noimage.jpg') {
                Storage::delete('public/images/' . $doctor->image);
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $doctor->image = $fileNameToStore;
        }

        $doctor->update([
            'name' => $validateData['name'],
            'specialization' => $validateData['specialization'],
            'education' => $validateData['education'],
        ]);

        $doctor->save();

        return redirect()->route('admin.viewDoctors')->with('success', 'Doctor updated successfully');
    }

    function deleteDoctor($id){
        $doctor = Doctor::findOrFail($id);

        if($doctor->image && $doctor->image != 'noimage.jpg'){
            Storage::delete('public/images/') . $doctor->image;
        }

        $doctor->delete();
        return redirect()->route('admin.viewDoctors')->with('success', 'Doctor deleted successfully');
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
