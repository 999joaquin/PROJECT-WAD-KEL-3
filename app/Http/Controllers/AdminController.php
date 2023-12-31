<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\User;


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
}
