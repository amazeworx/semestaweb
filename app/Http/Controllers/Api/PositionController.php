<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Occupation;
use App\Models\Position;

class PositionController extends Controller
{
  public function index()
  {
    $positions = Position::all();
    return response()->json($positions);
  }

  public function get($occupation)
  {
    $occupation_id = Occupation::find($occupation);
    $jobPositions = $occupation_id->positions()->distinct()->get();
    return response()->json($jobPositions);
  }
}
