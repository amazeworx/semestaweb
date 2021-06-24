<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDistrict;

class SubdistrictController extends Controller
{
  public function index()
  {
    $subdistricts = SubDistrict::all();
    return response()->json($subdistricts);
  }

  public function get($district_id)
  {
    $subdistricts = SubDistrict::where('district_id', $district_id)->orderBy('name', 'asc')->get();
    return response()->json($subdistricts);
  }
}
