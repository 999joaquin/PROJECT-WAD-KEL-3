<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Article;

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
