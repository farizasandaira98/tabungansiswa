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

Route::get('/', function () {
    return view('welcome');
});

//Route Login
//Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin', 'AdminController@index')->name('admin');

    //route datasiswa
    Route::get('/admin/datasiswa', 'DataSiswaController@index');
    Route::get('/admin/datasiswa/tambah', 'DataSiswaController@tambah');
    Route::post('/admin/datasiswa/store', 'DataSiswaController@store');
    Route::get('/admin/datasiswa/edit/{id}', 'DataSiswaController@edit');
    Route::post('/admin/datasiswa/update/{id}', 'DataSiswaController@update');
    Route::get('/admin/datasiswa/hapus/{id}', 'DataSiswaController@destroy');
    Route::get('/admin/datasiswa/cari', 'DataSiswaController@search');

    //route transaksi penarikan
    Route::get('/admin/transaksipenarikan', 'TransaksiPenarikanController@index');
    Route::get('/admin/transaksipenarikan/tambah', 'TransaksiPenarikanController@tambah');
    Route::post('/admin/transaksipenarikan/store', 'TransaksiPenarikanController@store');
    Route::get('/admin/transaksipenarikan/edit/{id}', 'TransaksiPenarikanController@edit');
    Route::post('/admin/transaksipenarikan/update/{id}', 'TransaksiPenarikanController@update');
    Route::get('/admin/transaksipenarikan/hapus/{id}', 'TransaksiPenarikanController@destroy');
    Route::get('/admin/transaksipenarikan/cari', 'TransaksiPenarikanController@search');

    //route transaksi setoran
    Route::get('/admin/transaksisetoran', 'TransaksiSetoranController@index');
    Route::get('/admin/transaksisetoran/tambah', 'TransaksiSetoranController@tambah');
    Route::post('/admin/transaksisetoran/store', 'TransaksiSetoranController@store');
    Route::get('/admin/transaksisetoran/edit/{id}', 'TransaksiSetoranController@edit');
    Route::post('/admin/transaksisetoran/update/{id}', 'TransaksiSetoranController@update');
    Route::get('/admin/transaksisetoran/hapus/{id}', 'TransaksiSetoranController@destroy');
    Route::get('/admin/transaksisetoran/cari', 'TransaksiSetoranController@search');

    //route laporan transaksi
    Route::get('/admin/laporantransaksi', 'LaporanTransaksiController@index');
    Route::get('/admin/laporantransaksi/tambah', 'LaporanTransaksiController@tambah');
    Route::post('/admin/laporantransaksi/store', 'LaporanTransaksiController@store');
    Route::get('/admin/laporantransaksi/edit/{id}', 'LaporanTransaksiController@edit');
    Route::post('/admin/laporantransaksi/update/{id}', 'LaporanTransaksiController@update');
    Route::get('/admin/laporantransaksi/hapus/{id}', 'LaporanTransaksiController@destroy');
    Route::get('/admin/laporantransaksi/cari', 'LaporanTransaksiController@search');
    Route::get('/admin/laporantransaksi/cetak', 'LaporanTransaksiController@cetak_pdf');

    //Route Data Admin
        Route::get('/admin/dataadmin', 'AdminController@dataadmin');
        Route::get('/admin/dataadmin/hapus/{id}', 'AdminController@dataadminhapus');
        Route::get('/admin/dataadmincari', 'AdminController@dataadmincari');

    Route::get('logout', 'AuthController@logout')->name('logout');
});
