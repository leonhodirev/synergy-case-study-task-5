<?php

namespace App\Livewire\Travels;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Travel;

class TravelsCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $latitude = '';
    public $longitude = '';
    public $cost = '';
    public $images = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'cost' => 'nullable|numeric',
        'images.*' => 'image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $travel = Travel::create([
            'title' => $this->title,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'cost' => $this->cost,
            'user_id' => auth()->id(),
        ]);

        foreach ($this->images as $image) {
            $path = $image->store('public/travel_images');
            $travel->images()->create(['path' => $path]);
        }

        session()->flash('success', 'Путешествие добавлено!');
        return redirect()->route('travels.index');
    }

    public function render()
    {
        return view('livewire.travels.form', ['isEdit' => false]);
    }
}
