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
    Route::get('/calendar', Calendar::class)->name('calendar');
    Route::get('/calendar/{date}', DayView::class)->name('calendar.date');
});

require __DIR__.'/auth.php';
