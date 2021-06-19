<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenAccount;

class VueOpenAccountController extends Controller
{
  public function index(Request $request)
  {
    return view('web.vue.vue-open-account');
  }

  // Store Form data
  public function store(Request $request)
  {

    //  Store data in database
    $storeData = OpenAccount::create($request->all());

    //return back()->with('success', 'Thank you.');
    //return redirect()->route('form-open-account');
    return response()->json($storeData);
  }
}
