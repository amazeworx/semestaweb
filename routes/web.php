<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomepageController;
use App\Http\Controllers\Web\AboutUsController;
use App\Http\Controllers\Web\OurServicesController;
use App\Http\Controllers\Web\MarketNewsController;
use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\LocalizationController;
use App\Http\Controllers\Admin\DailyMarketController;
use App\Http\Controllers\Admin\ZipDownloadController;

use App\Http\Controllers\Web\FormOpenAccountController;
use App\Http\Controllers\Web\VueOpenAccountController;

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

Route::get('lang/{lang}', [LocalizationController::class, 'switch'])->name('localization.switch');

/*
| WEB
*/
Route::get('/', [HomepageController::class, 'index']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/our-services', [OurServicesController::class, 'index']);
Route::get('/market-news', [MarketNewsController::class, 'index']);
Route::get('/contact-us', [ContactUsController::class, 'index']);
Route::view('/download', 'web.download');
Route::get('/lw-open-account', \App\Http\Livewire\OpenAccount\OpenAccountForm::class);

/*
| ADMIN
*/
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', function () {
  return view('admin.accounts');
})->name('accounts');
Route::middleware(['auth:sanctum', 'verified'])->resource('daily-market', DailyMarketController::class);
Route::get('download-zip', [ZipDownloadController::class, 'index'])->name('download-zip');

/*
| EXPERIMENTAL
*/
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
  return view('web.form-open-account');
});

Route::get('/open-account/{any}', function () {
  return view('web.vue.vue-open-account');
})->where('any', '.*');

Route::get('/open-account', [VueOpenAccountController::class, 'index'])->name('open-account');
