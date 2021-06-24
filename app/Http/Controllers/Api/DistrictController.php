<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
  public function index()
  {
    $districts = District::all();
    return response()->json($districts);
  }

  public function get($city_id)
  {
    $districts = District::where('city_id', $city_id)->orderBy('name', 'asc')->get();
    return response()->json($districts);
  }
}
