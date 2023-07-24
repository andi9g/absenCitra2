<?php

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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return redirect('home');
    });

    // Route::get('pdf', 'startController@pdf');

    // Route::get('siswa/export/', 'startController@export');

    Route::middleware(['GerbangSuperadmin'])->group(function () {
        Route::get('laporan', 'laporanC@index');
        Route::get('cetak/laporan', 'laporanC@cetak')->name('cetak');

        Route::resource('siswa', 'siswaC');
        Route::post('reset/siswa/{id}', 'siswaC@reset')->name('siswa.reset');
        Route::post('reset/ketuakelas/{id}', 'siswaC@ketuakelas')->name('siswa.hapus.ketuakelas');

        Route::resource('guru', 'guruC');
        Route::post('reset/guru/{id}', 'guruC@reset')->name('guru.reset');

        //kelas
        Route::post('kelas/tambah', 'pengaturanC@store_kelas')->name('kelas.store');
        Route::put('kelas/ubah/{idkelas}', 'pengaturanC@update_kelas')->name('kelas.update');
        Route::delete('kelas/hapus/{idkelas}', 'pengaturanC@destroy_kelas')->name('kelas.destroy');
        //mapel
        Route::post('mapel/tambah', 'pengaturanC@store_mapel')->name('mapel.store');
        Route::put('mapel/ubah/{idmapel}', 'pengaturanC@update_mapel')->name('mapel.update');
        Route::delete('mapel/hapus/{idmapel}', 'pengaturanC@destroy_mapel')->name('mapel.destroy');

        Route::resource('admin', 'adminC');
        Route::post('reset/admin/{id}', 'adminC@reset')->name('admin.reset');
        Route::get('pengaturan', 'pengaturanC@index');

    });




    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Route::get('absen', 'absenC@tampil')->middleware('GerbangGuru');
    Route::get('absen/{idkelas}', 'absenC@data');
    Route::post('absen/{nis}', 'absenC@absen')->name('absen.absen');





});



