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

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
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
    }
