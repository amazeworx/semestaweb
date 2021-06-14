<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Management;

class ManagementPerson extends Component
{
  public $personId;
  public $personName;
  public $personPosition;
  public $personBiography;
  public $personImage;

  public function mount($personId)
  {
    $this->personId = $personId;
    $person = Management::where('id', $personId)->first();
    $this->personName = $person->name;
    $this->personPosition = $person->position;
    $this->personBiography = $person->biography;
    $this->personImage = $person->image_src;
  }

  public function render()
  {
    return view('livewire.web.management-person');
  }
}
