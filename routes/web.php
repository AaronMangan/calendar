<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Calendar\Calendar;
use App\Models\CalendarEvent;
use App\Models\EventType;
use App\Livewire\Calendar\DayView;
use App\Livewire\Calendar\CreateNewEvent;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard', 
    [
        'count' => App\Models\CalendarEvent::count() ?? 0,
    ]
)->middleware(['auth', 'verified'])
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
    
    Route::get('/calendar/event/create', CreateNewEvent::class)
        ->middleware('permission:edit calendar')
        ->name('calendar.event.create');
});

require __DIR__.'/auth.php';
