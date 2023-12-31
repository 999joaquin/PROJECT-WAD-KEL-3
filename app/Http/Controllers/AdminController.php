<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    function addSchedule(Request $request){ // ario
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

}