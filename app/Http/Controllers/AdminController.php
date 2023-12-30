<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    public function viewPatients(){
        return view('admin.view-patients');
    }

}