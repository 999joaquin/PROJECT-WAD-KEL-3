<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\Detail;
use App\Models\Schedule;
use App\Models\Medicin;
use App\Models\Article;

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

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
    
            return redirect()->route('admin.dashboard')->with('success', 'Doctor added successfully');
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
    
        return redirect()->route('admin.viewDoctors')->with('success', 'Doctor updated successfully.');
    }

    function deleteDoctor($id){ 
        $doctor = Doctor::findOrFail($id);

        if($doctor->image && $doctor->image != 'noimage.jpg'){
            Storage::delete('public/images/') . $doctor->image;
        }

        $doctor->delete();
        return redirect()->route('admin.viewDoctors')->with('success', 'Doctor deleted successfully.');
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
        return view('admin.add-schedule', compact('doctors'));
    }

    function viewSchedules(){
        $schedules = Schedule::with('doctor')->get();
        return view('admin.view-schedules', compact('schedules'));
    }

    function editSchedule($scheduleId){
        $schedule = Schedule::findOrFail($scheduleId);
        $doctors = Doctor::all();
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
    }

    function viewPatients(){ 
        $patients = Patient::all();
        return view('admin.view-patients', compact('patients'));
    }

    function editPatients(Patient $patient){ 
        return view('admin.edit-patients', compact('patient'));
    }

    function updatePatients(Request $request, Patient $patient){ 
        $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:12',
            'address' => 'required|string'
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.dashboard')->with('success', 'Data pasien telah berhasil di update');
    }

    function destroyPatients(Patient $patient){ 
        $patient->delete();
        return redirect()->route('admin.patients.dashboard')->with('success', 'Data pasien berhasil dihapus');
    }

    function showPatientsDetails($patientId){ 
        $patient = Patient::findOrFail($patientId);
        return view('admin.add-details', compact('patient'));
    }

    function addPatientDetails(Request $request, $patientId){ 
        $request->validate([
            'medical_record' => 'required',
            'disease' => 'required',
            'medication' => 'required'
        ]);

        Detail::create([
            'patient_id' => $patientId,
            'medical_record' => $request->medical_record,
            'disease' => $request->disease,
            'medication' => $request->medication
        ]);

        return redirect()->route('admin.selectPatient')->with('success', 'Sukses');
    }

    function selectPatient(){ 
        $patients = Patient::all();
        return view('admin.select-patient', compact('patients'));
    }

    function showPatientFullDetails($patientId){ 
        $patient = Patient::with('details')->findOrFail($patientId);
        return view('admin.patient-details', compact('patient'));
    }

    function deleteDetail($detailId){ 
        $detail = Detail::findOrFail($detailId);
        $detail -> delete();

        return back()->with('success', 'Berhasil di hapus');
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

    function articleIndex()
    {
        $article = Article::all();
        return view('admin.article.index', compact ('article'));
    }

    function articleDetail($id)
    {
        $singleArticle = Article::find($id);
        return view('admin.article.detail', ['singleArticle' => $singleArticle]);
    }

    function articleCreate()
    {
        return view('admin.article.create');
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'paragraph' => 'required|string|max:5000',
            'author' => 'required|string',
            'date_of_writing' => 'required|date',
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->paragraph = $request->input('paragraph');
        $article->author = $request->input('author');
        $article->date_of_writing = $request->input('date_of_writing');
        $article->save();

        return redirect()->route('admin.articleIndex')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function articleUpdate(Request $request)
    {
        $id = $request->route('id');
        $article = Article::find($id);
        if (!$article) {
            return redirect()->route('admin.articleIndex')->with('error', 'Artikel tidak ditemukan');
        }
        $article->title = $request->input('title');
        $article->paragraph = $request->input('paragraph');
        $article->author = $request->input('author');
        $article->date_of_writing = $request->input('date_of_writing');
        $article->save();
        return redirect()->route('admin.articleIndex')->with('success','Artikel berhasil diperbarui');
    }

    function articleEdit($id){
        $singleArticle = Article::find($id);
        return view('admin.article.edit', ['singleArticle' => $singleArticle]);
    }


    function articleDelete(Request $request)
    {
        $id = $request->route('id');
        $article = Article::find($id);
        $article -> delete();
        return redirect()->route('admin.articleIndex')->with('success', 'Article deleted.');
    }
}
