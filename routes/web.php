<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/leads', function () {
    return view('leads.index');
})->middleware(['auth', 'verified'])->name('leads.index');

Route::get('/opportunities', function () {
    return 'opportunitiesopportunities Page';
})->middleware(['auth', 'verified'])->name('opportunities.index');

Route::get('/reminders', function () {
    return 'reminders Page';
})->middleware(['auth', 'verified'])->name('reminders.index');

Route::get('/contacts', function () {
    return view('customers');
})->middleware(['auth', 'verified'])->name('contacts.index');


require __DIR__.'/auth.php';
