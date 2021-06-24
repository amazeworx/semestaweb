<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Occupation;
use App\Models\Position;
use App\Models\Business;


class BusinessController extends Controller
{
  public function get($occupation, $position)
  {
    $position_id = Position::find($position);
    $businessFields = $position_id->businesses()->where('occupation_id', $occupation)->distinct()->get();
    return response()->json($businessFields);
  }
}
