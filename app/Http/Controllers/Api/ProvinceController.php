<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
  public function index()
  {
    $provinces = Province::whereNotIn('ksei_code', array(999, 1000))->orderBy('name', 'asc')->get();
    return response()->json($provinces);
  }
}
