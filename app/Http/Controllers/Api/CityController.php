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

  public function ksei_cities()
  {
    $cities = City::select('ksei_name')->whereNotIn('ksei_code', array(141, 142, 143, 144, 145))->distinct()->orderBy('ksei_name', 'asc')->get();
    return response()->json($cities);
  }

  public function get($province_id)
  {
    $cities = City::where('province_id', $province_id)->whereNotIn('ksei_code', array(251))->orderBy('name', 'asc')->get();
    return response()->json($cities);
  }
}
