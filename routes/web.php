<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MutasiTagBin1Controller;
use App\Http\Controllers\MutasiTagBin2Controller;
use App\Http\Controllers\MutasiTagBin3Controller;
use App\Http\Controllers\MutasiTagBin4Controller;
use App\Http\Controllers\MutasiCW1Controller;
use App\Http\Controllers\MutasiCW2Controller;
use App\Http\Controllers\MutasiCW3Controller;
use App\Http\Controllers\MutasiCW4Controller;
use App\Http\Controllers\MutasiCW5Controller;
use App\Http\Controllers\MutasiD1Controller;
use App\Http\Controllers\MutasiD2Controller;
use App\Http\Controllers\MutasiD3Controller;
use App\Http\Controllers\MutasiD4Controller;
use App\Http\Controllers\CrystalReport1Controller;
use App\Http\Controllers\CrystalReport2Controller;
use App\Http\Controllers\CrystalReport3Controller;
use App\Http\Controllers\CrystalReport4Controller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'mutasi_tag_bin1' => MutasiTagBin1Controller::class,
    'mutasi_tag_bin2' => MutasiTagBin2Controller::class,
    'mutasi_tag_bin3' => MutasiTagBin3Controller::class,
    'mutasi_tag_bin4' => MutasiTagBin4Controller::class,
    'mutasi_cw1' => MutasiCW1Controller::class,
    'mutasi_cw2' => MutasiCW2Controller::class,
    'mutasi_cw3' => MutasiCW3Controller::class,
    'mutasi_cw4' => MutasiCW4Controller::class,
    'mutasi_cw5' => MutasiCW5Controller::class,
    'mutasi_d1' => MutasiD1Controller::class,
    'mutasi_d2' => MutasiD2Controller::class,
    'mutasi_d3' => MutasiD3Controller::class,
    'mutasi_d4' => MutasiD4Controller::class,
    'crystal_report1' => CrystalReport1Controller::class,
    'crystal_report2' => CrystalReport2Controller::class,
    'crystal_report3' => CrystalReport3Controller::class,
    'crystal_report4' => CrystalReport4Controller::class,
]);

Route::post('import-excel-mutasi-tagbin1', [MutasiTagBin1Controller::class, 'importExcel']);
Route::get('download-template-mutasi-tagbin', [MutasiTagBin1Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-tagbin1', [MutasiTagBin1Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-tagbin1', [MutasiTagBin1Controller::class, 'cetakBarcode'])->name('mutasi-tagbin1.cetak_barcode');
Route::get('generate-qr-mutasi-tagbin1', [MutasiTagBin1Controller::class, 'cetakQR'])->name('mutasi-tagbin1.cetak_qr');

Route::post('import-excel-mutasi-tagbin2', [MutasiTagBin2Controller::class, 'importExcel']);
Route::get('download-template-mutasi-tagbin2', [MutasiTagBin2Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-tagbin2', [MutasiTagBin2Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-tagbin2', [MutasiTagBin2Controller::class, 'cetakBarcode'])->name('mutasi-tagbin2.cetak_barcode');
Route::get('generate-qr-mutasi-tagbin2', [MutasiTagBin2Controller::class, 'cetakQR'])->name('mutasi-tagbin2.cetak_qr');

Route::post('import-excel-mutasi-tagbin3', [MutasiTagBin3Controller::class, 'importExcel']);
Route::get('download-template-mutasi-tagbin3', [MutasiTagBin3Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-tagbin3', [MutasiTagBin3Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-tagbin3', [MutasiTagBin3Controller::class, 'cetakBarcode'])->name('mutasi-tagbin3.cetak_barcode');
Route::get('generate-qr-mutasi-tagbin3', [MutasiTagBin3Controller::class, 'cetakQR'])->name('mutasi-tagbin3.cetak_qr');

Route::post('import-excel-mutasi-tagbin4', [MutasiTagBin4Controller::class, 'importExcel']);
Route::get('download-template-mutasi-tagbin4', [MutasiTagBin4Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-tagbin4', [MutasiTagBin4Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-tagbin4', [MutasiTagBin4Controller::class, 'cetakBarcode'])->name('mutasi-tagbin4.cetak_barcode');
Route::get('generate-qr-mutasi-tagbin4', [MutasiTagBin4Controller::class, 'cetakQR'])->name('mutasi-tagbin4.cetak_qr');

Route::post('import-excel-mutasi-cw1', [MutasiCW1Controller::class, 'importExcel']);
Route::get('download-template-mutasi-cw1', [MutasiCW1Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-cw1', [MutasiCW1Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-cw1', [MutasiCW1Controller::class, 'cetakBarcode'])->name('mutasi-cw1.cetak_barcode');
Route::get('generate-qr-mutasi-cw1', [MutasiCW1Controller::class, 'cetakQR'])->name('mutasi-cw1.cetak_qr');

Route::post('import-excel-mutasi-cw2', [MutasiCW2Controller::class, 'importExcel']);
Route::get('download-template-mutasi-cw2', [MutasiCW2Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-cw2', [MutasiCW2Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-cw2', [MutasiCW2Controller::class, 'cetakBarcode'])->name('mutasi-cw2.cetak_barcode');
Route::get('generate-qr-mutasi-cw2', [MutasiCW2Controller::class, 'cetakQR'])->name('mutasi-cw2.cetak_qr');

Route::post('import-excel-mutasi-cw3', [MutasiCW3Controller::class, 'importExcel']);
Route::get('download-template-mutasi-cw3', [MutasiCW3Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-cw3', [MutasiCW3Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-cw3', [MutasiCW3Controller::class, 'cetakBarcode'])->name('mutasi-cw3.cetak_barcode');
Route::get('generate-qr-mutasi-cw3', [MutasiCW3Controller::class, 'cetakQR'])->name('mutasi-cw3.cetak_qr');

Route::post('import-excel-mutasi-cw4', [MutasiCW4Controller::class, 'importExcel']);
Route::get('download-template-mutasi-cw4', [MutasiCW4Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-cw4', [MutasiCW4Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-cw4', [MutasiCW4Controller::class, 'cetakBarcode'])->name('mutasi-cw4.cetak_barcode');
Route::get('generate-qr-mutasi-cw4', [MutasiCW4Controller::class, 'cetakQR'])->name('mutasi-cw4.cetak_qr');

Route::post('import-excel-mutasi-cw5', [MutasiCW5Controller::class, 'importExcel']);
Route::get('download-template-mutasi-cw5', [MutasiCW5Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-cw5', [MutasiCW5Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-cw5', [MutasiCW5Controller::class, 'cetakBarcode'])->name('mutasi-cw5.cetak_barcode');
Route::get('generate-qr-mutasi-cw5', [MutasiCW5Controller::class, 'cetakQR'])->name('mutasi-cw5.cetak_qr');

Route::post('import-excel-mutasi-d1', [MutasiD1Controller::class, 'importExcel']);
Route::get('download-template-mutasi-d', [MutasiD1Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-mutasi-d1', [MutasiD1Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-d1', [MutasiD1Controller::class, 'cetakBarcode'])->name('mutasi-d1.cetak_barcode');
Route::get('generate-qr-mutasi-d1', [MutasiD1Controller::class, 'cetakQR'])->name('mutasi-d1.cetak_qr');

Route::post('import-excel-mutasi-d2', [MutasiD2Controller::class, 'importExcel']);
Route::get('delete-all-mutasi-d2', [MutasiD2Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-d2', [MutasiD2Controller::class, 'cetakBarcode'])->name('mutasi-d2.cetak_barcode');
Route::get('generate-qr-mutasi-d2', [MutasiD2Controller::class, 'cetakQR'])->name('mutasi-d2.cetak_qr');

Route::post('import-excel-mutasi-d3', [MutasiD3Controller::class, 'importExcel']);
Route::get('delete-all-mutasi-d3', [MutasiD3Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-d3', [MutasiD3Controller::class, 'cetakBarcode'])->name('mutasi-d3.cetak_barcode');
Route::get('generate-qr-mutasi-d3', [MutasiD3Controller::class, 'cetakQR'])->name('mutasi-d3.cetak_qr');

Route::post('import-excel-mutasi-d4', [MutasiD4Controller::class, 'importExcel']);
Route::get('delete-all-mutasi-d4', [MutasiD4Controller::class, 'deleteAll']);
Route::get('generate-barcode-mutasi-d4', [MutasiD4Controller::class, 'cetakBarcode'])->name('mutasi-d4.cetak_barcode');
Route::get('generate-qr-mutasi-d4', [MutasiD4Controller::class, 'cetakQR'])->name('mutasi-d4.cetak_qr');

Route::post('import-excel-crystal-report1', [CrystalReport1Controller::class, 'importExcel']);
Route::get('download-template-crystal-report1', [CrystalReport1Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-crystal-report1', [CrystalReport1Controller::class, 'deleteAll']);
Route::get('generate-barcode-crystal-report1', [CrystalReport1Controller::class, 'cetakBarcode'])->name('crystal-report1.cetak_barcode');
Route::get('generate-qr-crystal-report1', [CrystalReport1Controller::class, 'cetakQR'])->name('crystal-report1.cetak_qr');

Route::post('import-excel-crystal-report2', [CrystalReport2Controller::class, 'importExcel']);
Route::get('download-template-crystal-report2', [CrystalReport2Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-crystal-report2', [CrystalReport2Controller::class, 'deleteAll']);
Route::get('generate-barcode-crystal-report2', [CrystalReport2Controller::class, 'cetakBarcode'])->name('crystal-report2.cetak_barcode');
Route::get('generate-qr-crystal-report2', [CrystalReport2Controller::class, 'cetakQR'])->name('crystal-report2.cetak_qr');

Route::post('import-excel-crystal-report3', [CrystalReport3Controller::class, 'importExcel']);
Route::get('download-template-crystal-report3', [CrystalReport3Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-crystal-report3', [CrystalReport3Controller::class, 'deleteAll']);
Route::get('generate-barcode-crystal-report3', [CrystalReport3Controller::class, 'cetakBarcode'])->name('crystal-report3.cetak_barcode');
Route::get('generate-qr-crystal-report3', [CrystalReport3Controller::class, 'cetakQR'])->name('crystal-report3.cetak_qr');

Route::post('import-excel-crystal-report4', [CrystalReport4Controller::class, 'importExcel']);
Route::get('download-template-crystal-report4', [CrystalReport4Controller::class, 'downloadImportTemplate']);
Route::get('delete-all-crystal-report4', [CrystalReport4Controller::class, 'deleteAll']);
Route::get('generate-barcode-crystal-report4', [CrystalReport4Controller::class, 'cetakBarcode'])->name('crystal-report4.cetak_barcode');
Route::get('generate-qr-crystal-report4', [CrystalReport4Controller::class, 'cetakQR'])->name('crystal-report4.cetak_qr');