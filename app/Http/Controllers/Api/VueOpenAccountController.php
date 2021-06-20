<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenAccount;

class VueOpenAccountController extends Controller
{

  public function get(Request $request)
  {
    $data = OpenAccount::orderBy('created_at', 'desc')->get();
    return response()->json($data);
  }

  public function store(Request $request)
  {
    $storeData = OpenAccount::create([
      'full_name' => $request->fullName,
      'nationality' => $request->nationality,
    ]);

    return response()->json($storeData);
  }

  public function delete($id)
  {
    OpenAccount::destroy($id);

    return response()->json("ok");
  }
}
