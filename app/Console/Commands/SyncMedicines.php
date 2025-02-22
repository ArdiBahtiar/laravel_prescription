<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Medicine;
use App\Models\MedicinePrice;

class SyncMedicines extends Command
{
    protected $signature = 'sync:medicines';
    protected $description = 'Sync medicines and prices from API';


    public function handle()
    {
        $bearerToken = '9e2ceb58-4e33-4d17-adf2-c353de17b67d|j3YwTjjruBfrkI9XQepZJg61xoFkgU8H4jso4qgx0e58297b';
        $apiUrl = 'http://recruitment.rsdeltasurya.com/api/v1/medicines';

        $response = Http::withToken($bearerToken)->get($apiUrl);

        if ($response->successful()) {
            foreach ($response->json()['medicines'] as $medicineData) {
                $medicine = Medicine::updateOrCreate(
                    ['id' => $medicineData['id']],
                    ['name' => $medicineData['name']]
                );

                // Fetch prices for each medicine
                $priceUrl = "http://recruitment.rsdeltasurya.com/api/v1/medicines/{$medicine->id}/prices";
                $priceResponse = Http::withToken($bearerToken)->get($priceUrl);

                if ($priceResponse->successful()) {
                    foreach ($priceResponse->json()['prices'] as $priceData) {
                        MedicinePrice::updateOrCreate(
                            ['id' => $priceData['id']],
                            [
                                'medicine_id' => $medicine->id,
                                'unit_price' => $priceData['unit_price'],
                                'start_date' => $priceData['start_date']['value'],
                                'end_date' => $priceData['end_date']['value']
                            ]
                        );
                    }
                }
            }
            $this->info('Medicine and price data successfully synced!');
        } else {
            $this->error('Failed to fetch medicine data.');
        }
    }
}
