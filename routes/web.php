<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockProductController;
use App\Http\Controllers\SupplierController;
use App\Livewire\ProductFormula;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
    return view('dashboard');
});

Route::get('gudang', [GudangController::class, 'dataGudang']);
Route::post('rak/store', [GudangController::class, 'storeRak']);

Route::get('barang', [BarangController::class, 'dataBarang']);
Route::get('newBarang', [BarangController::class, 'newBarangForm']);
Route::post('newBarang', [BarangController::class, 'newBarang']);

Route::get('supplier', [SupplierController::class, 'dataSupplier']);
Route::post('supplier/store', [SupplierController::class, 'storeSupplier']);
Route::delete('supplier/delete', [SupplierController::class, 'delete'])->name('supplier.delete');

Route::get('barangMasuk', [BarangMasukController::class, 'dataMasuk']);
Route::post('barang/masuk', [BarangMasukController::class, 'brgMasuk']);

Route::get('barangKeluar', [BarangKeluarController::class, 'dataKeluar']);
Route::post('barang/keluar', [BarangKeluarController::class, 'brgKeluar']);


Route::get('customer', [CustomerController::class, 'dataCustomer']);
Route::post('customer/store', [CustomerController::class, 'storeCustomer']);
Route::delete('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');


Route::get('product', [ProductsController::class, 'dataProduct']);
Route::get('product/store', [ProductsController::class, 'newProductForm']);
Route::post('product/store', [ProductsController::class, 'newProduct']);
Route::delete('product/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');

Livewire::component('product-formula', ProductFormula::class);


Route::get('formula', [ProductsController::class, 'formula']);
Route::post('/produksi/product', [StockProductController::class, 'storeProduction']);

Route::get('stock/lot', [StockController::class, 'lot']);
Route::get('stock/barang', [StockController::class, 'stock']);
Route::get('stock/product', [StockProductController::class, 'stock']);


Route::get('/manufacturer', [ManufacturerController::class, 'dataManufacturer']);
Route::post('/manufacturer/store', [ManufacturerController::class, 'storeManufacturer']);
Route::get('/manufacturer/update/{id}', [ManufacturerController::class, 'updateManufacturer']);
Route::put('/manufacturer/update/{id}', [ManufacturerController::class, 'update']);
Route::delete('/manufacturer/delete/{id}', [ManufacturerController::class, 'delete'])->name('manufacturer.delete');














