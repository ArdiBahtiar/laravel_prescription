<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Checkup;
use App\Models\Prescription;
use Illuminate\Http\Request;

class IndexController extends Controller
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

    public function create()
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'patients' => Patient::orderBy('id', 'asc')->get(),
            'medicines' => Medicine::orderBy('id', 'asc')->get(),
        ];
        return view('apps.examination')->with($data);
    }

    public function index()
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'patient' => Patient::all(),
            'checkups' => Checkup::all()
        ];
        return view('apps.dashboard')->with($data);
    }

    public function indexReceipt()
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'mailbox',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('apps.resi_pembayaran')->with($data);
    }
}
