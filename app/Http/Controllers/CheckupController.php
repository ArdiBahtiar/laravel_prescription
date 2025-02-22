<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Medicine;
use App\Models\MedicinePrice;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckupController extends Controller
{
    public function indexPatient()
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('apps.assign_patient')->with($data);
    }

    public function storePatient(Request $request)
    {
        Patient::create($request->all());
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return redirect('/assign_patient')->with($data);
    }


    public function store(Request $request)
    {
        // dd($request);
    
        $filePath = $request->file('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;
        $checkup = Checkup::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => auth()->id(),
            'checkup_date' => $request->checkup_date,
            'height' => $request->height,
            'weight' => $request->weight,
            'systole' => $request->systole,
            'diastole' => $request->diastole,
            'heart_rate' => $request->heart_rate,
            'respiration_rate' => $request->respiration_rate,
            'temperature' => $request->temperature,
            'diagnosis' => $request->diagnosis,
        ]);
    
        $prescription = Prescription::create([
            'checkup_id' => $checkup->id,
            'doctor_id' => auth()->id(),
            'status' => 'pending',
        ]);

        foreach ($request->medicines as $index => $medicine_id) {
            PrescriptionMedicine::create([
                'prescription_id' => $prescription->id,
                'medicine_id' => $medicine_id, // Langsung ambil dari array medicines
                'quantity' => $request->quantities[$index], // Ambil quantity berdasarkan index
                'price' => $request->prices[$index], // Ambil price berdasarkan index
            ]);
        }
    
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return redirect('/checkup/create')->with($data);
    }

}
