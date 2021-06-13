<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyMarket;

class DailyMarketController extends Controller
{
  public function index()
  {
    return view('admin.daily-market.index');
  }

  public function create()
  {
    /// menampilkan halaman create
    return view('admin.daily-market.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'content' => 'required',
      'post_date' => 'required',
    ]);
    if ($request->has('draft')) {
      $post_status = 'draft';
    } else if ($request->has('publish')) {
      $post_status = 'publish';
    }
    $request->merge([
      'post_status' => $post_status,
    ]);
    DailyMarket::create($request->all());
    return redirect()->route('daily-market.index')
      ->with('success', 'Post created successfully.');
  }

  public function show(DailyMarket $dailyMarket)
  {
    return view('admin.daily-market.show', compact('dailyMarket'));
  }

  public function edit(DailyMarket $dailyMarket)
  {
    return view('admin.daily-market.edit', compact('dailyMarket'));
  }

  public function update(Request $request, DailyMarket $dailyMarket)
  {
    $request->validate([
      'content' => 'required',
      'post_date' => 'required',
    ]);
    if ($request->has('draft')) {
      $post_status = 'draft';
    } else if ($request->has('publish')) {
      $post_status = 'publish';
    }
    $request->merge([
      'post_status' => $post_status,
    ]);
    $dailyMarket->update($request->all());
    return redirect()->route('daily-market.index')
      ->with('success', 'Post updated successfully');
  }

  public function destroy(DailyMarket $dailyMarket)
  {
    $dailyMarket->delete();

    return redirect()->route('daily-market.index')
      ->with('success', 'Post deleted successfully');
  }
}
