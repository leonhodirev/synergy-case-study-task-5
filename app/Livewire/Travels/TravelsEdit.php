<?php

namespace App\Livewire\Travels;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Travel;

class TravelsEdit extends Component
{
    use WithFileUploads;

    public Travel $travel;
    public $title;
    public $latitude;
    public $longitude;
    public $cost;
    public $images = [];
    public $existingImages = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'cost' => 'nullable|numeric',
        'images.*' => 'image|max:2048',
    ];

    public function mount(Travel $travel)
    {
        $this->travel = $travel;
        $this->title = $travel->title;
        $this->latitude = $travel->latitude;
        $this->longitude = $travel->longitude;
        $this->cost = $travel->cost;
        $this->existingImages = $travel->images()->get();
    }

    public function save()
    {
        $this->validate();

        $this->travel->update([
            'title' => $this->title,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'cost' => $this->cost,
        ]);

        foreach ($this->images as $image) {
            $path = $image->store('public/travel_images');
            $this->travel->images()->create(['path' => $path]);
        }

        session()->flash('success', 'Путешествие обновлено!');
        return redirect()->route('travels.index');
    }

    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);
        if ($image && $image->travel_id === $this->travel->id) {
            $image->delete();
            $this->existingImages = $this->travel->images()->get();
        }
    }

    public function render()
    {
        return view('livewire.travels.form', ['isEdit' => true]);
    }
}
