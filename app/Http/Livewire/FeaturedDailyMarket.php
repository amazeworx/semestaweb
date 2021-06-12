<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DailyMarket;
use Helper;

class FeaturedDailyMarket extends Component
{
  public $post_id, $post_date, $post_excerpt, $post_content, $trimwords;

  public function mount($trimwords)
  {
    $featured_post = DailyMarket::where('post_status', 'publish')->orderBy('post_date', 'desc')->first();
    $this->post_id = $featured_post->id;
    $this->post_date = date('D, d M Y', strtotime($featured_post->post_date));
    $this->post_excerpt = Helper::trimwords($featured_post->content, $trimwords);
    $this->post_content = $featured_post->content;
  }

  public function render()
  {
    return view('livewire.featured-daily-market');
  }
}
