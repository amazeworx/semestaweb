<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipDownloadController extends Controller
{
  public function index(Request $request)
  {
    // https://laraveldaily.com/how-to-create-zip-archive-with-files-and-download-it-in-laravel/
    $zip_file = $request->id . '.zip';
    $zip = new \ZipArchive();
    $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

    $path = storage_path('app/public/files/' . $request->id);
    $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
    foreach ($files as $name => $file) {
      if (!$file->isDir()) {
        $filePath     = $file->getRealPath();
        $relativePath = substr($filePath, strlen($path) + 1);
        $zip->addFile($filePath, $relativePath);
      }
    }
    $zip->close();
    return response()->download($zip_file);
  }
}
