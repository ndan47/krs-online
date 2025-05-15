<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Maatwebsite\Excel\Facades\Excel;
//file export excel prodi start
use App\Exports\ProdiExport;
//file export excel prodi end

//file export pdf prodi start
use App\Http\Controllers\ProdiPDFController;
//file export pdf prodi end

//file export excel matkul start
use App\Exports\MatkulExport;
//file export excel matkul end

//file export pdf Matkul start
use App\Http\Controllers\MatkulPDFController;
//file export pdf Matkul end

//file export excel mahasiswa start
use App\Exports\MahasiswaExport;
//file export excel mahasiswa end

//file export pdf mahasiswa start
use App\Http\Controllers\MahasiswaPDFController;
//file export pdf mahasiswa end

// file export excel KRS start
use App\Exports\KrsExport;
// file export excel KRS End

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

// Route::get('/', function () {
//     return view('main');
// });

// ROUTES LOGIN START
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ROUTES LOGIN END

// ROUTES REGIST START
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// ROUTES REGIST END

// ROUTES DASHBOARD START
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('jwt.auth')
    ->name('dashboard.index');
// ROUTES DASHBOARD END

// ROUTES PRODI START
Route::middleware(['jwt.auth:admin'])->group(function () {
    Route::get('prodi', [ProdiController::class, 'index'])->name('prodi.index');
    // Route::get('prodi/create', [ProdiController::class, 'create']);
    Route::post('prodi', [ProdiController::class, 'store']);
    Route::get('prodi/edit/{id}', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('prodi/update/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
});

// ROUTES PRODI END


// ROUTES MAHASISWA START
Route::middleware(['jwt.auth:admin'])->group(function () {
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    // Route::get('mahasiswa/create', [MahasiswaController::class, 'create']);
    Route::post('mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('mahasiswa/edit{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('mahasiswa/update{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('mahasiswa/delete{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});
// ROUTES MAHASISWA END


// ROUTES MATA KULIAH START
Route::middleware(['jwt.auth:admin'])->group(function () {
    Route::get('matkul', [MatkulController::class, 'index'])->name('matkul.index');
    // Route::get('matkul/create', [MatkulController::class, 'create']);
    Route::post('matkul', [MatkulController::class, 'store']);
    Route::get('matkul/edit/{id}', [MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('matkul/update/{id}', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('matkul/delete/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');
});
// ROUTES MATA KULIAH END


// ROUTES KRS START

Route::get('krs', [KrsController::class, 'index'])->name('krs.index');
Route::middleware(['jwt.auth:admin'])->group(function () {
    // Route::get('krs', [KrsController::class, 'create']);
    Route::post('krs', [KrsController::class, 'store']);
    Route::get('krs/edit/{id}', [KrsController::class, 'edit'])->name('krs.edit');
    Route::put('krs/update/{id}', [KrsController::class, 'update'])->name('krs.update');
    Route::delete('krs/delete/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
});
Route::get('/export-krs-pdf', [KrsController::class, 'exportPdf'])->name('krs.exportPdf');
// ROUTES KRS END

// ROUTES EXPORT EXCEL PRODI START
Route::get('/export-prodi', function () {
    return Excel::download(new ProdiExport, 'prodi.xlsx');
});
// ROUTES EXPORT EXCEL PRODI END

// ROUTES EXPORT PDF PRODI START
Route::get('/export-prodi-pdf', [ProdiPDFController::class, 'exportPdf']);
// ROUTES EXPORT PDF PRODI END

// ROUTES EXPORT EXCEL MATKUL START
Route::get('/export-matkul', function () {
    return Excel::download(new MatkulExport, 'MatKul.xlsx');
});
// ROUTES EXPORT EXCEL MATKUL END

// ROUTES EXPORT PDF Matkul START
Route::get('/export-matkul-pdf', [MatkulPDFController::class, 'exportPdf']);
// ROUTES EXPORT PDF Matkul END


// ROUTES EXPORT EXCEL MAHASISWA START
Route::get('/export-mahasiswa', function () {
    return Excel::download(new MahasiswaExport, 'Mahasiswa.xlsx');
});
// ROUTES EXPORT EXCEL MAHASISWA END

// ROUTES EXPORT PDF Mahasiswa START
Route::get('/export-mahasiswa-pdf', [MahasiswaPDFController::class, 'exportPdf']);
// ROUTES EXPORT PDF Mahasiswa END

// ROUTES EXPORT EXCEL KRS START
Route::get('/export-krs', function () {
    return Excel::download(new KrsExport, 'KRS.xlsx');
});
// ROTES EXPORT EXCEL END

// ROUTES EXPORT PDF KRS START

// ROUTES EXPORT PDF KRS END