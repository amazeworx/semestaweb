<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\OpenAccount;

class LeadController extends Controller
{
  public function get(Request $request)
  {
    $data = Lead::orderBy('id', 'desc')->get();
    return response()->json($data);
  }

  public function store(Request $request)
  {
    $wni = $request->wni;
    $has_bca = $request->has_bca;
    $email = $request->email;

    $lead = Lead::where('email', '=', $email)->first();

    if ($lead) {
      // If Lead Exist, return Lead ID and Account ID
      // $openAccount = OpenAccount::where('lead_id', $lead->id)->latest()->first();
      // $account_id = "";
      // $account_status = "";
      // if ($openAccount) {
      //   $account_id = $openAccount->id;
      //   $account_status = $openAccount->status;
      // }
      return response()->json([
        'id' => $lead->id,
        // 'account_id' => $account_id,
        // 'account_status' => $account_status,
        'message' => "Lead Exist",
        'status' => "exist"
      ]);
    } else {
      $storeData = Lead::create([
        'wni' => $wni,
        'has_bca' => $has_bca,
        'email' => $email,
      ]);

      return response()->json($storeData);
    }
  }

  public function delete($id)
  {
    Lead::destroy($id);

    return response()->json("ok");
  }
}
