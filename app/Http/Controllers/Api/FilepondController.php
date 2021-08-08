<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilepondController extends Controller
{
  public function store(Request $request)
  {
    if ($request->hasFile('upload_ktp')) {
      $file = $request->file('upload_ktp');
      $fileExtension = $file->getClientOriginalExtension();
      $filename = 'KTP.' . $fileExtension;
      $folder = uniqid() . '-' . now()->timestamp;
      $file->storePubliclyAs('uploads/tmp/' . $folder, $filename, 'public');

      TemporaryFile::create([
        'folder' => $folder,
        'filename' => $filename,
      ]);

      return $folder;
    }
    if ($request->hasFile('upload_passport')) {
      $file = $request->file('upload_passport');
      $fileExtension = $file->getClientOriginalExtension();
      $filename = 'Passport.' . $fileExtension;
      $folder = uniqid() . '-' . now()->timestamp;
      $file->storePubliclyAs('uploads/tmp/' . $folder, $filename, 'public');

      TemporaryFile::create([
        'folder' => $folder,
        'filename' => $filename,
      ]);

      return $folder;
    }
    if ($request->hasFile('upload_npwp')) {
      $file = $request->file('upload_npwp');
      $fileExtension = $file->getClientOriginalExtension();
      $filename = 'NPWP.' . $fileExtension;
      $folder = uniqid() . '-' . now()->timestamp;
      $file->storePubliclyAs('uploads/tmp/' . $folder, $filename, 'public');

      TemporaryFile::create([
        'folder' => $folder,
        'filename' => $filename,
      ]);

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
