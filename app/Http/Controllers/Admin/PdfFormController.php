<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenAccount;
use PDF;

class PdfFormController extends Controller
{
  public function view(OpenAccount $id)
  {
    //return view('admin.accounts.form-view', compact('id'));

    //return view('admin.accounts.form-view', ['id' => $id]);
    return view('admin.accounts.form-view', ['data' => $id]);
  }

  public function createPDF(OpenAccount $id)
  {
    //view()->share('id', $id);
    $pdf = PDF::loadView('export_pdf', ['data' => $id]);

    // download PDF file with download method
    return $pdf->download('pdf_file.pdf');
  }
}
