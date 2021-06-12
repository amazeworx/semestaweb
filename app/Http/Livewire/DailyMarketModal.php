<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class DailyMarketModal extends ModalComponent
{
  public $post_id;
  public $post_content;
  public $post_date;

  protected $listeners = ['forceCloseModal'];

  public function mount($post_id, $post_content, $post_date)
  {
    $this->post_id = $post_id;
    $this->post_content = $post_content;
    $this->post_date = $post_date;
  }

  public function render()
  {
    return view('livewire.daily-market-modal');
  }

  public function forceCloseModal()
  {
    $this->forceClose()->closeModal();
  }
}
