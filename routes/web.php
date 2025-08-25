<?php

use Livewire\Volt\Volt;
use App\Livewire\Admin\KycDetail;
use App\Service\CardCreateService;
use App\Livewire\Admin\KycManagment;
use App\Livewire\Admin\BankManagment;
use App\Livewire\Admin\UserManagment;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Card\CardManagment;
use App\Livewire\Admin\Card\CardOrderDetail;
use App\Livewire\Admin\Card\CardOrderManagment;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('users', UserManagment::class)->name('userManagment');
    Route::get('kyc', KycManagment::class)->name('kycManagment');
    route::get('kyc-detail/{uuid}', KycDetail::class)->name('kycDetail');

    route::get('banks', BankManagment::class)->name('adminBanks');

    //cards
    Route::get('card-orders', CardOrderManagment::class)->name('admincardOrder');
    Route::get('card-order/{uuid}', CardOrderDetail::class)->name('adminCardOrderDetail');
    Route::get('cards', CardManagment::class)->name('adminCards');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/test', function () {
    return (new CardCreateService())->storeVirtualCard();
})->name('otp');

require __DIR__ . '/auth.php';