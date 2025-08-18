<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\PdfController;


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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/api/sum/{a}/{b}', [apiController::class, 'sum'])
     ->name('api.sum');
Route::get('/sum-page', [apiController::class, 'showForm'])
->name('sum.page');

Route::get('/gfolder', [PdfController::class, 'index2']);
Route::get('/check-drive-id', function () {
    $id = env('GOOGLE_DRIVE_FOLDER_ID');
    dd([
        'raw'    => $id,
        'length' => strlen($id),
        'endsWithDot' => Str::endsWith($id, '.'),
    ]);
});
