<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\SubdistrictController;
use App\Http\Controllers\Api\OccupationController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\FilepondController;
use App\Http\Controllers\Api\FormOpenAccountController;
use App\Http\Controllers\Api\VueOpenAccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Route::apiResource('countries', CountryController::class);
// Route::apiResource('occupation', OccupationController::class);
// Route::apiResource('position', PositionController::class);
Route::apiResource('form-open-account', FormOpenAccountController::class);
//Route::apiResource('vue-open-account', VueOpenAccountController::class);

Route::get('countries', [CountryController::class, 'index']);
Route::get('province', [ProvinceController::class, 'index']);
Route::get('city', [CityController::class, 'index']);
Route::get('city/{province_id}', [CityController::class, 'get']);
Route::get('district', [DistrictController::class, 'index']);
Route::get('district/{city_id}', [DistrictController::class, 'get']);
Route::get('subdistrict', [SubdistrictController::class, 'index']);
Route::get('subdistrict/{district_id}', [SubdistrictController::class, 'get']);
Route::get('occupation', [OccupationController::class, 'index']);
Route::get('occupation/{id}', [OccupationController::class, 'get']);
Route::get('position', [PositionController::class, 'index']);
Route::get('position/{occupation}', [PositionController::class, 'get']);
Route::get('business/{occupation}/{position}', [BusinessController::class, 'get']);
Route::post('upload', [FilepondController::class, 'store']);
Route::delete('upload', [FilepondController::class, 'delete']);

Route::get('vue-open-account', [VueOpenAccountController::class, 'get']);
Route::post('vue-open-account', [VueOpenAccountController::class, 'store']);
Route::delete('vue-open-account/{id}', [VueOpenAccountController::class, 'delete']);
