<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MarketNews extends Component
{
  public $perPage;
  public $textSize;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($perPage, $textSize)
  {
    $this->perPage = $perPage;
    $this->textSize = $textSize;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    $feed = \Feeds::make(['https://id.investing.com/rss/news_25.rss'], 10);
    $feed_data = array(
      'feed_title'     => $feed->get_title(),
      'feed_permalink' => $feed->get_permalink(),
      'feed_items'     => $feed->get_items(),
    );
    return view('components.market-news', $feed_data);
  }
}
