<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DailyMarket;

class PreviousDailyMarket extends Component
{
  use WithPagination;

  public function render()
  {
    $collection = DailyMarket::where('post_status', 'publish')->orderBy('post_date', 'desc')->paginate(10);

    return view('livewire.web.previous-daily-market', [
      'previous_posts' => $collection,
    ]);
  }
}
