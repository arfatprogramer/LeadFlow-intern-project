<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class contactControler extends Controller
{
    public function index()
    {
        try {
            $roles = Auth::user()->role_names;

            if (array_intersect($roles, ['admin', 'manager'])) {
                $contacts = Contact::with(['user'])->orderBy('updated_at','desc')->get();
            } else {
                $contacts = Contact::where('assigned_to', Auth::id())->orderBy('updated_at','desc')->get();
            }

            return view('contacts.index', compact('contacts'));

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            //
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $contact = Contact::with(['user','lead'])->findOrFail($id);
            return view('contacts.show', compact('contact'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            //
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        try {
             $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            return back()->with('success', 'Contact deleted successfully.');
        }

        return back()->with('error', 'Something went wrong while deleting the contact.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // This function for display Logs
    public function log($id)
    {
        try {
            $contact = Contact::with(['activityLogs','lead.activityLogs'])->OrderBy('created_at','desc')->findOrFail($id);
            $logs = collect();

            if ($contact->activityLogs) {
                $logs = $logs->merge($contact->activityLogs);
            }

            if ($contact->lead && $contact->lead->activityLogs) {
                $logs = $logs->merge($contact->lead->activityLogs);
            }

            $logName = $contact->first_name . " " . $contact->last_name;
            return view('show-logs', compact('logs','logName'));

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
