<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Occupation;

class OccupationController extends Controller
{
  public function index()
  {
    $occupations = Occupation::all();
    return response()->json($occupations);
  }

  public function get($id)
  {
    $occupation = Occupation::where('id', $id)->get();
    return response()->json($occupation);
  }
}
