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
route::get('/','AuthController@view_login')->name('login');
route::post('/Auth-login','AuthController@do_login');
Route::get('/logout','AuthController@logout');

route::group(['middleware'=>['auth','checkRole:admin,petugas,siswa']],function(){
    route::get('/dashboard/datasiswa/details/{id}','DataSiswaController@profile')->name('profile');

        // PDF
        route::get('/dashboard/exportPDF/siswa','DataSiswaController@siswaExport_pdf')->name('exportPDFSiswa');
        route::get('/dashboard/exportPDF/spp','DataSppController@sppExport_pdf')->name('exportPDFSpp');
        route::get('/dashboard/exportPDF/bukti-pembayaran-{id}','DataPembayaranController@kwitansiExport_pdf')->name('kwitansi');
        // EndPDF
});
route::group(['middleware' => ['auth','checkRole:admin,petugas']],function(){
    route::get('/dashboard','DashboardController@index')->name('dashboard');

    route::get('/dashboard/datapembayaran','DataPembayaranController@index');
    route::post('/dashboard/datapembayaran/save-data','DataPembayaranController@do_save');
    route::get('/dashboard/datapembayaran/delete-data/{id}','DataPembayaranController@do_delete');
    route::get('/dashboard/notification','NotificationController@index');
    route::post('/dashboard/send-notification','NotificationController@send_notification');
    route::post('/dashboard/send-all-notification','NotificationController@send_all_notification')->name('send-all');
});

route::group(['middleware'=>['auth','checkRole:admin']],function(){
    route::get('/dashboard/petugas','AuthController@view_petugas');
    route::post('/dashboard/petugas/save-data','AuthController@do_save');
    route::post('/dashboard/petugas/update-data/{id}','AuthController@do_update');
    Route::get('/dashboard/petugas/delete-data/{id}','AuthController@do_delete');


    route::get('/dashboard/datasiswa','DataSiswaController@index')->name('datasiswa');
    route::post('dashboard/datasiswa/save-data','DataSiswaController@do_save');
    route::get('/dashboard/datasiswa/delete-data/{id}','DataSiswaController@do_delete');
    route::post('/dashboard/datasiswa/update-data/{id}','DataSiswaController@do_update');

    route::get('/dashboard/datakelas','DataKelasController@index');
    route::post('/dashboard/datakelas/save-data','DataKelasController@do_save');
    route::get('/dashboard/datakelas/delete-data/{id}','DataKelasController@do_delete');
    route::post('/dashboard/datakelas/update-data/{id}','DataKelasController@do_update');

    route::get('/dashboard/dataspp','DataSppController@index');
    route::post('/dashboard/dataspp/save-data','DataSppController@do_save');
    route::get('/dashboard/dataspp/delete-data/{id}','DataSppController@do_delete');
    route::post('/dashboard/dataspp/update-data/{id}','DataSppController@do_update');

    route::get('/dashboard/laporan','DataSppController@index');

    // Excel
    route::get('/dashboard/export/siswa','DataSiswaController@siswaExport_excel')->name('exportExcelSiswa');
    route::post('/dashboard/import/siswa','DataSiswaController@siswaImport_excel')->name('importExcelSiswa');
    
    route::get('/dashboard/export/kelas','DataKelasController@kelasExport_excel')->name('exportExcelKelas');
    route::post('/dashboard/import/kelas','DataKelasController@kelasImport_excel')->name('importExcelKelas');

    route::get('/dashboard/export/spp','DataSppController@sppExport_excel')->name('exportExcelSpp');
    route::post('/dashboard/import/spp','DataSppController@sppImport_excel')->name('importExcelSpp');
    // EndExcel
});
