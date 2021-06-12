<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormOpenAccountController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\OurServicesController;
use App\Http\Controllers\MarketNewsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DailyMarketController;
use App\Http\Controllers\ZipDownloadController;

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

Route::get('/', [HomepageController::class, 'index']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/our-services', [OurServicesController::class, 'index']);
Route::get('/market-news', [MarketNewsController::class, 'index']);
Route::get('/contact-us', [ContactUsController::class, 'index']);
Route::get('/open-account', \App\Http\Livewire\OpenAccount\OpenAccountForm::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', function () {
//   return view('admin.accounts');
// })->name('accounts');
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', function () {
  return view('admin.accounts');
})->name('accounts');

Route::middleware(['auth:sanctum', 'verified'])->resource('daily-market', DailyMarketController::class);

Route::get('download-zip', [ZipDownloadController::class, 'index'])->name('download-zip');

//Route::resource('form', \App\Http\Controllers\FormOpenAccountController::class);
//Route::get('/form', [FormOpenAccountController::class, 'create']);
// Route::get('/form', 'App\Http\Controllers\FormOpenAccountController@index');
// Route::post('/form', 'App\Http\Controllers\FormOpenAccountController@index');
// Route::get('/form', [FormOpenAccountController::class, 'index']);
// Route::post('/form', [FormOpenAccountController::class, 'store'])->name('form-open-account.store');
//Route::resource('form', [FormOpenAccountController::class]);
Route::resource('account-opening', FormOpenAccountController::class);

Route::get('/{lang}/account-opening', function ($lang) {
  App::setlocale($lang);
  return view('form-open-account');
});
