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

  public function uploadSignature(Request $request)
  {
    //https://www.codecheef.org/article/laravel-signature-pad-example-tutorial-from-scratch
    $folderPath = public_path('upload/');

    $image_parts = explode(";base64,", $request->signed);

    $image_type_aux = explode("image/", $image_parts[0]);

    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);

    $file = $folderPath . uniqid() . '.' . $image_type;
    file_put_contents($file, $image_base64);
    return back()->with('success', 'success');

    // $data_uri = $this->uploadSignature;
    // $encoded_image = explode(",", $data_uri)[1];
    // $decoded_image = base64_decode($encoded_image);
    // Storage::put('public/files/' . $stored_data->id . '/TandaTangan.png', $decoded_image, 'public');

  }
}
