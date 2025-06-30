<?php

use App\Livewire\Travels\TravelsCreate;
use App\Livewire\Travels\TravelsEdit;
use App\Livewire\Travels\TravelsIndex;
use App\Livewire\Travels\TravelsShow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::prefix('travels')->name('travels.')->group(function () {
        Route::get('/', TravelsIndex::class)->name('index');
        Route::get('/create', TravelsCreate::class)->name('create');
        Route::get('/{travel}/edit', TravelsEdit::class)->name('edit');
        Route::get('/{travel}', TravelsShow::class)->name('show');
    });
});

Route::get('/dashboard', function () {
    return redirect()->route('travels.index');
})->name('dashboard');

require __DIR__.'/auth.php';
