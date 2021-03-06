<?php

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
    return view('dashboard');
});


Route::get('/barang', 'BarangController@index');
Route::get('/barang/print', 'BarangController@pdf');
Route::get('/barang/create', 'BarangController@create');
Route::post('/barang', 'BarangController@store');
Route::get('/barang/edit/{id_barang}', 'BarangController@edit');
Route::put('/barang/{id}/edit', 'BarangController@update');
Route::delete('/barang/{id}', 'BarangController@destroy');

Route::get('/supplier', 'SupplierController@index');
Route::get('/supplier/create', 'SupplierController@create');
Route::get('/supplier/edit/{id}', 'SupplierController@edit');
Route::put('/supplier/{id}/edit', 'SupplierController@update');
Route::post('/supplier', 'SupplierController@store');
Route::delete('/supplier/{id}', 'SupplierController@destroy');

Route::get('/customer', 'CustomerController@index');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/edit/{id}', 'CustomerController@edit');
Route::put('/customer/{id}/edit/', 'CustomerController@update');
Route::delete('/customer/{id}', 'CustomerController@destroy');

Route::get('/pembelian', 'PembelianController@index');
Route::get('/pembelian/create/{id}', 'PembelianController@create');
Route::post('/pembelian/barang/', 'PembelianController@tambahBarang');
Route::post('/pembelian', 'PembelianController@store');
Route::get('/pembelian/clear', 'PembelianController@clear');
Route::get('/pembelian/fetch/{id}', 'PembelianController@fetch')->name('supplier');
Route::get('/pembelian/barang/{id}', 'PembelianController@barang')->name('barang');
Route::get('/pembelian/detail/{id}', 'PembelianController@detail_barang');

Route::get('/detail_pembelian', 'DetailPembelianController@index');
Route::get('/detail_pembelian/print/{id}', 'DetailPembelianController@pdf');
Route::get('/detail_pembelian/hutang/{id}', 'DetailPembelianController@edit');
Route::get('/detail_pembelian/retur/{id}', 'DetailPembelianController@retur');
Route::post('/detail_pembelian/retur/', 'DetailPembelianController@tambahBarang');
Route::post('/detail_pembelian/returbarang/', 'DetailPembelianController@returBarang');
Route::get('/detail_pembelian/barang/{id}/{id_pembelian}', 'DetailPembelianController@barang');
Route::put('/detail_pembelian/{id}/hutang', 'DetailPembelianController@update');
Route::get('/detail_pembelian/{id}/{id_pembelian}', 'DetailPembelianController@hapusBarang');

Route::get('/kartu_stok', 'KartuStokController@index');
Route::get('/kartu_stok/fetch/{id}', 'KartuStokController@fetch');

Route::get('/penjualan', 'PenjualanController@index');
Route::get('/penjualan/create', 'PenjualanController@create');
Route::post('/penjualan', 'PenjualanController@store');
Route::post('/penjualan/barang/', 'PenjualanController@tambahBarang');
Route::get('/penjualan/fetch/{id}', 'PenjualanController@fetch');
Route::get('/penjualan/barang/{id}', 'PenjualanController@barang');
Route::get('/penjualan/detail/{id}', 'PenjualanController@detail_barang');

Route::get('/detail_penjualan', 'DetailPenjualanController@index');

Route::get('/retur', 'ReturController@index');
Route::get('/retur/detail/{id}', 'ReturController@detail');

Route::get('/hutang', 'HutangPembelianController@index');
