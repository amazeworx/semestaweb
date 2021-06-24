<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilepondController extends Controller
{
  public function store(Request $request)
  {
    if ($request->hasFile('upload_ktp')) {
      $file = $request->file('upload_ktp');
      $fileExtension = $file->getClientOriginalExtension();
      $folder = uniqid() . '-' . now()->timestamp;
      $file->storeAs('uploads/tmp/' . $folder, 'KTP.' . $fileExtension);

      return $folder;
    }
    return '';
  }

  public function delete(Request $request)
  {
    $temp_folder = $request->getContent();
    Storage::deleteDirectory('uploads/tmp/' . $temp_folder);
  }
}
