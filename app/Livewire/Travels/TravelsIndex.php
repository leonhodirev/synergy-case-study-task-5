<?php

namespace App\Livewire\Travels;

use App\Models\Travel;
use Livewire\Component;

class TravelsIndex extends Component
{
    public $travels;
    public bool $onlyMy = false;

    public function mount()
    {
        $this->loadTravels();
    }

    public function toggleOnlyMy()
    {
        $this->onlyMy = !$this->onlyMy;
        $this->loadTravels();
    }

    public function loadTravels()
    {
        $query = Travel::with('images', 'user');
        if ($this->onlyMy) {
            $query->where('user_id', auth()->id());
        } else {
            $query->where('user_id', '!=', auth()->id());
        }
        $this->travels = $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.travels.index');
    }
}
