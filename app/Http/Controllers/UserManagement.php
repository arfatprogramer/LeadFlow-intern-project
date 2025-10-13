<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagement extends Controller
{
    public function index()
    {   
        $roles=Auth::user()->role_names;
        if (array_intersect($roles,['admin'])) {
   
            $users= User::with(['roles'])->orderBy('updated_at',"desc")->get();
            // return($users);
            return view('userManaments.index',compact('users'));
        }
        abort(403, 'You are not authorized to access this page.');
    }
}
