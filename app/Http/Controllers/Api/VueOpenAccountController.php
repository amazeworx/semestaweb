<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenAccount;

class VueOpenAccountController extends Controller
{
  public function store(Request $request)
  {

    // Form validation
    // $this->validate($request, [
    //   'full_name' => 'required',
    //   'nationality' => 'required',
    //   'ktp_number' => 'required',
    //   'email' => 'required|email',
    //   'mother_name' => 'required',
    // ]);

    //  Store data in database
    $storeData = OpenAccount::create([
      'full_name' => $request->full_name,
      'nationality' => $request->nationality,
    ]);
    //return $storeData;
    return response()->json($storeData);
  }
}
