<?php

namespace App\Livewire\Travels;

use App\Models\Travel;
use Livewire\Component;

class TravelsShow extends Component
{
    public $travel;

    public function mount(Travel $travel)
    {
        // Ограничение доступа только для владельца
        abort_unless($travel->user_id === auth()->id(), 403);
        $this->travel = $travel->load('images');
    }

    public function render()
    {
        return view('livewire.travels.show');
    }
}
