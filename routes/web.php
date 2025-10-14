<?php

use App\Http\Controllers\contactControler;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\leadsController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagement;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//created by me
Route::middleware(['auth'])->group(function () {

    Route::get('/',[DashBoardController::class,'index'])->name('dashboard');

    Route::resource('leads', LeadsController::class);
    Route::get('leads/logs/{id}', [LeadsController::class,'log'])->name('leads.log');
    Route::post('leads/bulk-delete', [LeadsController::class,'bulkDestroy'])->name('leads.bulk-delete');
    Route::post('leads/bulk-update', [LeadsController::class, 'bulkUpdate'])->name('leads.bulk-update');
    Route::get('leads/follo-up/{id}', [LeadsController::class,'OpenUpdateFollowUp'])->name('leads.OpenUpdateFollowUp');
    Route::post('leads/follo-up/{id}', [LeadsController::class,'updateFollowUp'])->name('leads.updateFollowUp');

    // Opportunities Resource Controlleer
    Route::resource('opportunities', OpportunitiesController::class);
    Route::get('opportunities/logs/{id}', [OpportunitiesController::class,'log'])->name('opportunities.log');

    
    //Contacts Resource Controlleer
    Route::resource('contacts', contactControler::class);
    Route::get('contacts/logs/{id}', [contactControler::class,'log'])->name('contacts.log');

    //User Managemant
    Route::get('/employes',[UserManagement::class,'index'])->name('employes.index');
    Route::get('/employes/show/{id}',[UserManagement::class,'show'])->name('employes.show');
    Route::get('/employes/roles/{id}', [UserManagement::class, 'editRoles'])->name('employes.roles');
    Route::post('/employes/roles/{id}', [UserManagement::class, 'updateRoles'])->name('employes.updateRoles');
    
});

Route::get('/test',function(){
    return view('dashboard');
});


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
        if ($lead_id==0) {
            return back();
        }
    return redirect()->route('leads.show', $lead_id);
})->name('markasread');


require __DIR__.'/auth.php';
