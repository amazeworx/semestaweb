<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketNewsController extends Controller
{
  public function index()
  {
    return view('market-news');
  }
}
