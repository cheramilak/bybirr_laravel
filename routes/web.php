<?php

use App\Livewire\Admin\BankManagment;
use App\Livewire\Admin\KycDetail;
use App\Livewire\Admin\KycManagment;
use App\Livewire\Admin\UserManagment;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('users',UserManagment::class)->name('userManagment');
    Route::get('kyc',KycManagment::class)->name('kycManagment');
    route::get('kyc-detail/{uuid}',KycDetail::class)->name('kycDetail');

    route::get('banks',BankManagment::class)->name('adminBanks');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
