<?php

namespace App\Http\Controllers;

use App\Models\OpenAccount;

use Illuminate\Http\Request;

class FormOpenAccountController extends Controller
{
  // Create Form
  public function index(Request $request)
  {
    return view('account-opening');
  }

  // Store Form data
  public function store(Request $request)
  {

    // Form validation
    $this->validate($request, [
      'full_name' => 'required',
      'nationality' => 'required',
      'nik' => 'required',
      'email' => 'required|email'
    ]);

    //  Store data in database
    OpenAccount::create($request->all());

    return back()->with('success', 'Thank you.');
    //return redirect()->route('form-open-account');
  }
}
