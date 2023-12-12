<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

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


Route::get('header', [ExcelController::class, 'header']);
Route::get('header-many', [ExcelController::class, 'header2']);
Route::get('header-zip', [ExcelController::class, 'exportAndZip']);


Route::get('/welcome', function() {
    return view('welcome');
});


Route::get('/', function() {
    $data = [
        [
            "background" => "red",
            "headerRow" => [
                [
                    "title" => "Vui long nhap dia diem muon giao hang",
                    "col"   => 1,
                ],
                [
                    "title" => "Vui long nhap dia diem muon giao hang",
                    "col"   => 1,
                    "background" => "red",
                ],
            ],
        ],
        [
            "headerRow" => [
                [
                    "title" => "Vui long nhap dia diem muon giao hang",
                    "col"   => 3,
                ],
            ],
        ],
        [
            "headerRow" => [
                [
                    "title" => "Vui long nhap dia diem muon giao hang",
                    "col"   => 1,
                ],
                [
                    "title" => "Vui long nhap dia diem muon giao hang",
                    "col"   => 1,
                ],
            ],
        ],
    ];
});
