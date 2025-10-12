<?php

use App\Http\Controllers\leadsController;
use App\Http\Controllers\OpportunitiesController;
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

//created by me
Route::middleware(['auth'])->group(function () {
    Route::resource('leads', LeadsController::class);
    Route::post('leads/bulk-delete', [LeadsController::class,'bulkDestroy'])->name('leads.bulk-delete');
    Route::post('leads/{lead}/convert', [LeadsController::class,'convert'])->name('leads.convert');
    Route::resource('opportunities', OpportunitiesController::class);
});


Route::get('/reminders', function () {
    return 'reminders Page';
})->middleware(['auth', 'verified'])->name('reminders.index');

Route::get('/contacts', function () {
    return view('customers');
})->middleware(['auth', 'verified'])->name('contacts.index');

require __DIR__.'/auth.php';
