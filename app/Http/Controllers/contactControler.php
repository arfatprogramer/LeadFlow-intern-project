<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class contactControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->role_names;
        
        if (array_intersect($roles, ['admin', 'manager']))
        {
            $contacts = Contact::with(['user'])->orderBy('updated_at','desc')->get();
           
        }
        else
        {
            $contacts = Contact::where('assigned_to', Auth::id())->orderBy('updated_at','desc')->get();
        }
        
        return view('contacts.index',compact('contacts'));

        //  abort(403, 'You are not authorized to access this page.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::with(['user','lead'])->findOrFail($id);
        // return($contact);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //this function for display Logs
     public function log($id)
    {
        $contact=Contact::with(['activityLogs'])->OrderBy('created_at','desc')->findOrFail($id);
        $logs=collect();

        if ($contact->activityLogs) {
           $logs=$logs->merge($contact->activityLogs);
        }
        $logName=$contact->first_name." ".$contact->last_name;
        return view('show-logs',compact('logs','logName'));
    }
}
