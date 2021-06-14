<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\DailyMarket;

class DailyMarketModalFooter extends Component
{
  public $currentId;
  public $prev_id;
  public $prev_date;
  public $prev_content;
  public $next_id;
  public $next_date;
  public $next_content;

  public function mount($currentId)
  {
    $prev = DailyMarket::where('id', '<', $currentId)->orderBy('id', 'desc')->first();
    $next = DailyMarket::where('id', '>', $currentId)->orderBy('id', 'asc')->first();

    $this->current_id = $currentId;

    $this->prev_id = '';
    $this->prev_date = '';
    $this->prev_content = '';
    if ($prev) {
      $this->prev_id = $prev->id;
      $this->prev_date = $prev->post_date;
      $this->prev_content = $prev->content;
    }

    $this->next_id = '';
    $this->next_date = '';
    $this->next_content = '';
    if ($next) {
      $this->next_id = $next->id;
      $this->next_date = $next->post_date;
      $this->next_content = $next->content;
    }
  }

  public function render()
  {
    return view('livewire.web.daily-market-modal-footer');
  }
}
