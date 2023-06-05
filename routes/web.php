<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiItemController;

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

    Route::get('/', [AdminController::class, 'item'])->name('item.index');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dataget', [AdminController::class, 'dataget'])->name('admin.dataget');
    //Route::get('item', [AdminController::class, 'item'])->name('item.index');
    //admin api routes
    Route::get('/get-all-item', [ApiItemController::class, 'getAllItem'])->name('item.all');

    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item,{id}', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::post('/item/import_excel', [ItemController::class, 'import_excel'])->name('item.import_excel');
    Route::post('/item/import_bidang', [ItemController::class, 'import_bidang'])->name('item.import_bidang');
    Route::post('/item/import_kelompok', [ItemController::class, 'import_kelompok'])->name('item.import_kelompok');
    Route::post('/item/import_jenis', [ItemController::class, 'import_jenis'])->name('item.import_jenis');
    //Route::get('/data', [AdminController::class, 'dashboard'])->name('data.index');

    //Route::get('/siswa', 'SiswaController@index');
    Route::get('/item/export_excel', [ItemController::class, 'export_excel'])->name('item.export_excel');
    Route::post('/fetch-kelompok', [ItemController::class, 'fetchKelompok'])->name('item.fetch-kelompok');
    Route::post('/fetch-jenis', [ItemController::class, 'fetchJenis'])->name('item.fetch-jenis');
    Route::post('/get-data', [ItemController::class, 'getData'])->name('item.get-data');


    // Route::get('dropdown', [DropdownController::class, 'index']);
    // Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
    // Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);
//     @foreach ($totaljenis as $item)
//     jenis.push('{{ $item["jenis"] }}');
//     total_jenis.push('{{ $item["total"] }}');
// @endforeach
