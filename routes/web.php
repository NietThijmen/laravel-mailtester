<?php

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
});

Route::middleware(['auth'])->prefix('account')->group(function () {
    Route::get('/create', \App\Livewire\Email\CreateAccount::class)->name('account.create');
    Route::get('/{account}', \App\Livewire\Email\AccountOverview::class)->name('account.overview');
});

Route::middleware(['auth'])->prefix('emails')->group(function () {
    Route::get('/{email}', \App\Livewire\Email\Detail::class)->name('emails.detail');
});

require __DIR__.'/auth.php';
