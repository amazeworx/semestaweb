<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
  public function index()
  {
    $cities = City::all();
    return response()->json($cities);
  }

  public function get($province_id)
  {
    $cities = City::where('province_id', $province_id)->whereNotIn('ksei_code', array(251))->orderBy('name', 'asc')->get();
    return response()->json($cities);
  }
}
