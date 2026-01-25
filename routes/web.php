<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Calendar\Calendar;
use App\Livewire\Calendar\DayView;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Calendar Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Calendar Main View Route
    Route::get('/calendar', Calendar::class)
        ->middleware('permission:view calendar|edit calendar')
        ->name('calendar');
    
    // Day View Route
    Route::get('/calendar/{date}', DayView::class)
        ->middleware('permission:view calendar|edit calendar')
        ->name('calendar.date');
});

require __DIR__.'/auth.php';
