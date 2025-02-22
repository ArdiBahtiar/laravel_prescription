<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicinePrice;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function getMedicinePrice(Request $request)
    {
        $medicineId = $request->medicine_id;
        $checkupDate = $request->checkup_date;

        $price = MedicinePrice::where('medicine_id', $medicineId)
            ->where('start_date', '<=', $checkupDate)
            ->where(function ($query) use ($checkupDate) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $checkupDate);
            })
            ->orderBy('start_date', 'desc')
            ->value('unit_price');

        return response()->json(['price' => $price]);
    }
}
