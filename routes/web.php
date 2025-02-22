<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CheckupController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PrescriptionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'auth'] , function() {

    // $this->middleware
    // Route::prefix('dashboard')->group(function() {
    //     Route::get('/index', [TicketsController::class, 'index']);
    // });

    Route::prefix('checkup')->group(function() {
        // Route::get('/create', [CheckupController::class, 'create'])->name('create.checkup');
        Route::get('/create', [IndexController::class, 'create'])->name('create.checkup');
        Route::post('/store', [CheckupController::class, 'store'])->name('store.checkup');
    });

    // Route::get('/assign_patient', [CheckupController::class, 'indexPatient'])->name('index.patient');
    Route::get('/assign_patient', [IndexController::class, 'indexPatient'])->name('index.patient');
    Route::post('/assign_patient/assign', [CheckupController::class, 'storePatient'])->name('assign.patient');

    Route::get('/get-medicine-price', [MedicineController::class, 'getMedicinePrice']);

    Route::prefix('apps')->group(function () {
        Route::get('/mailbox', function() {
            // $category_name = 'mailbox';
            $data = [
                'category_name' => 'apps',
                'page_name' => 'mailbox',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'mailbox';
            return view('pages.apps.apps_mailbox')->with($data);
        });
    });

});

Auth::routes();

// Route::get('/', 'HomeController@index');
// Route::get('/home', [CheckupController::class, 'create'])->name('home');
// Route::get('/home', [PrescriptionController::class, 'index'])->name('home');
Route::get('/home', [IndexController::class, 'index'])->name('home');

Route::get('/register', function() {
    return redirect('/login');    
});
Route::get('/password/reset', function() {
    return redirect('/login');    
});

Route::get('/', function() {
    return redirect('/home');    
});
Auth::routes();

