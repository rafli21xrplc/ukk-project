<?php

use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\generate;
use App\Http\Controllers\Admin\kelasController;
use App\Http\Controllers\Admin\pembayaranController;
use App\Http\Controllers\Admin\petugasController;
use App\Http\Controllers\Admin\siswaController;
use App\Http\Controllers\Admin\sppController;
use App\Http\Controllers\Admin\userController;
use App\Http\Controllers\Petugas\dashboardController as PetugasDashboardController;
use App\Http\Controllers\Siswa\dashboardController as SiswaDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware('petugas')->controller(PetugasDashboardController::class)->group(function () {
    Route::get('dashboard-petugas', 'index')->name('dashboard.petugas');

    Route::post('tambah-pembayaran', 'store')->name('create.pembayaran.petugas');
    Route::delete('delete-pembayaran/{id}', 'destroy')->name('delete.pembayaran.petugas');
});

Route::middleware('user')->controller(SiswaDashboardController::class)->group(function () {
    Route::get('dashboard-siswa', 'index')->name('dashboard.siswa');
    Route::get('generate/{id}', 'generate')->name('generate.pembayaran.siswa');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::controller(dashboardController::class)->group(function () {
        Route::get('dashboard-admin', 'index')->name('dashboard.admin');
    });

    Route::controller(siswaController::class)->group(function () {
        Route::get('siswa', 'index')->name('siswa.admin');
        Route::post('tambah-siswa', 'store')->name('create.siswa.admin');
        Route::put('update-siswa', 'update')->name('update.siswa.admin');
        Route::delete('delete-siswa/{id}', 'destroy')->name('delete.siswa.admin');
    });

    Route::controller(kelasController::class)->group(function () {
        Route::get('kelas', 'index')->name('kelas.admin');
        Route::post('tambah-kelas', 'store')->name('create.kelas.admin');
        Route::put('update-kelas', 'update')->name('update.kelas.admin');
        Route::delete('delete-kelas/{id}', 'destroy')->name('delete.kelas.admin');
    });

    Route::controller(sppController::class)->group(function () {
        Route::get('spp', 'index')->name('spp.admin');
        Route::post('tambah-spp', 'store')->name('create.spp.admin');
        Route::put('update-spp', 'update')->name('update.spp.admin');
        Route::delete('delete-spp/{id}', 'destroy')->name('delete.spp.admin');
    });

    Route::controller(petugasController::class)->group(function () {
        Route::get('petugas', 'index')->name('petugas.admin');
        Route::post('tambah-petugas', 'store')->name('create.petugas.admin');
        Route::put('update-petugas', 'update')->name('update.petugas.admin');
        Route::delete('delete-petugas/{id}', 'destroy')->name('delete.petugas.admin');
    });

    Route::controller(pembayaranController::class)->group(function () {
        Route::get('pembayaran', 'index')->name('pembayaran.admin');
        Route::post('tambah-pembayaran', 'store')->name('create.pembayaran.admin');
        Route::put('update-pembayaran', 'update')->name('update.pembayaran.admin');
        Route::delete('delete-pembayaran/{id}', 'destroy')->name('delete.pembayaran.admin');
    });

    Route::controller(generate::class)->group(function () {
        Route::get('generate-pembayaran', 'generate')->name('admin.generate.pdf');
    });

    Route::controller(userController::class)->group(function () {
        Route::get('profile-request', 'index')->name('user.request.admin');
        Route::post('approve-user/{code}', 'approve')->name('admin.user.approve');
        Route::post('remove-user/{code}', 'destroy')->name('admin.user.remove');
    });
});
