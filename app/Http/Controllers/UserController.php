<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;

class UserController extends Controller
{
    function dashboard(){
        return view('user.dashboard');
    }

    function listDoctors(){
        $doctors = Doctor::all();
        return view('user.list-doctors', compact('doctors'));
    }

    function viewDoctorSchedule($doctorId){
        $doctor = Doctor::with('schedules')->findOrFail($doctorId);
        return view('user.view-schedule', compact('doctor'));
    }
}