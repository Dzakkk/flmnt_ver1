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
use App\Http\Livewire\FormulaProduct;
use App\Models\ProductionControl;
use App\Models\stockProduct;
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
Route::put('/barang/update/{id}', [BarangController::class, 'updateBarang']);


Route::get('supplier', [SupplierController::class, 'dataSupplier']);
Route::post('supplier/store', [SupplierController::class, 'storeSupplier']);
Route::delete('supplier/delete', [SupplierController::class, 'delete'])->name('supplier.delete');

Route::get('barangMasuk', [BarangMasukController::class, 'dataMasuk']);
Route::post('barang/masuk', [BarangMasukController::class, 'brgMasuk']);
Route::post('package/masuk', [BarangMasukController::class, 'storePackage']);

Route::get('barangKeluar', [BarangKeluarController::class, 'dataKeluar']);
Route::post('barang/keluar', [BarangKeluarController::class, 'brgKeluar']);
Route::get('/getRakOption', [BarangKeluarController::class, 'getRakOptions']);

Route::get('customer', [CustomerController::class, 'dataCustomer']);
Route::post('customer/store', [CustomerController::class, 'storeCustomer']);
Route::delete('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');


Route::get('product', [ProductsController::class, 'dataProduct']);
Route::get('product/store', [ProductsController::class, 'newProductForm']);
Route::post('product/store', [ProductsController::class, 'newProduct']);
Route::delete('product/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');
Route::get('/product/update/{id}', [ProductsController::class, 'updateProductForm'])->name('product.update');
Route::put('/product/update/{id}', [ProductsController::class, 'updateProduct']);



Route::get('formula', [ProductsController::class, 'formula'])->name('formula');
Route::post('/produksi/product', [StockProductController::class, 'storeProduction']);

Route::get('stock/lot', [StockController::class, 'lot']);
Route::get('stock/barang', [StockController::class, 'stock']);
Route::get('stock/product', [StockProductController::class, 'stock']);
Route::get('stock/kemasan', [StockController::class, 'packaging']);


Route::get('/manufacturer', [ManufacturerController::class, 'dataManufacturer']);
Route::post('/manufacturer/store', [ManufacturerController::class, 'storeManufacturer']);
Route::get('/manufacturer/update/{id}', [ManufacturerController::class, 'updateManufacturer']);
Route::put('/manufacturer/update/{id}', [ManufacturerController::class, 'update']);
Route::delete('/manufacturer/delete/{id}', [ManufacturerController::class, 'delete'])->name('manufacturer.delete');




Route::get('/barang/export', [BarangController::class, 'export']);
Route::get('export/production/control', [ProductsController::class, 'exportProductionControl']);

// Route::livewire('/product-form', [FormulaProduct::class]);
Livewire::component('/product-form', [FormulaProduct::class]);



Route::get('/search',[BarangController::class, 'search'])->name('search.index');

Route::get('/search/stock',[StockController::class, 'search'])->name('search.stock');


Route::get('production/form', [StockProductController::class, 'productionControl'])->name('production.form');
Route::post('production/control/store', [StockProductController::class, 'productProduction']);


// Route::get('pdf', [StockController::class, 'view']);
Route::get('/pdf', [StockProductController::class, 'generatePDF']);

Route::get('production/control', [StockProductController::class, 'dataProductionControl']);
Route::get('after/production/{id}', [StockProductController::class, 'afterProduction'])->where('id', '[\w\/]+');
Route::put('after/production/control/{id}', [StockProductController::class, 'productionAfter'])->where('id', '[\w\/]+');

Route::get('production/control/data', [ProductsController::class, 'dataProduction']);

Route::get('rekap', [StockController::class, 'rekap']);
Route::get('export/usage/{month}', [StockController::class, 'exportDataPerMonth']);

Route::get('test', function () {
    return view('form.layoutExcel.productionControlLayout');
});