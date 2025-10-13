<?php

namespace App\Http\Controllers;

use App\Models\Role;
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

    public function show($id)
    {
        $user=User::with('roles')->find($id);
        return view('userManaments.show',compact('user'));

    }

   public function editRoles($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::select('role_name')->distinct()->get();
        return view('userManaments.edit-roles', compact('user', 'roles'));
    }

    public function updateRoles(Request $request, $id)
        {
            // Delete all existing roles for this user
            Role::where('user_id', $id)->delete();

            // Insert new roles
            foreach ($request->roles ?? [] as $role) {
                Role::create([
                    'user_id' => $id,
                    'role_name' => $role,
                ]);
            }

            return redirect()
                ->route('employes.show', $id)
                ->with('success', '✅ Roles updated successfully!');
        }
}
