<?php

namespace App\Http\Livewire\Web;

use LivewireUI\Modal\ModalComponent;

class ManagementModal extends ModalComponent
{

  public $name;
  public $position;
  public $biography;
  public $image;

  protected $listeners = ['forceCloseModal'];

  public function mount($name, $position, $biography, $image_src)
  {
    $this->name = $name;
    $this->position = $position;
    $this->biography = $biography;
    $this->image = $image_src;
  }

  public function render()
  {
    return view('livewire.web.management-modal');
  }

  public function forceCloseModal()
  {
    $this->forceClose()->closeModal();
  }
}
