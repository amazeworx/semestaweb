<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\DailyMarket;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Helper;

class DailyMarketDataTable extends LivewireDatatable
{
  public $model = DailyMarket::class;
  public $hideable = 'select';

  public function columns()
  {
    return [
      NumberColumn::name('id'),
      DateColumn::name('post_date')->label('Post Date'),
      Column::callback(['content'], function ($content) {
        $content = strip_tags($content);
        $content = Helper::trimwords($content, 80);
        return strip_tags($content);
      })->label('Content'),
      Column::name('post_status')->label('Post Status'),
      Column::callback(['id'], function ($id) {
        return view('admin.daily-market.tableactions', ['id' => $id]);
      })->label('Actions'),
    ];
  }
}
