<?php

use App\Http\Controllers\leadsController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('leads/follo-up/{id}', [LeadsController::class,'OpenUpdateFollowUp'])->name('leads.OpenUpdateFollowUp');
    Route::post('leads/follo-up/{id}', [LeadsController::class,'updateFollowUp'])->name('leads.updateFollowUp');
    Route::resource('opportunities', OpportunitiesController::class);
});


Route::get('/reminders', function () {
    return 'reminders Page';
})->middleware(['auth', 'verified'])->name('reminders.index');

Route::get('/contacts', function () {
    return view('customers');
})->middleware(['auth', 'verified'])->name('contacts.index');

//Notifications
Route::post('/notifications/mark-all-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAllRead');

Route::get('/markasread/{id}/{lead_id}', function ($id, $lead_id) {
    $notification = Auth::user()->notifications()->find($id);

    if ($notification) {
        $notification->markAsRead();
    }
        // return back();
    return redirect()->route('leads.show', $lead_id);
})->name('markasread');


require __DIR__.'/auth.php';
