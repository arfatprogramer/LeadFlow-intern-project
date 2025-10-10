<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class leadsController extends Controller
{
   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role=='admin') {  
            $leads = Lead::all(); // Fetch all leads assigned to user with ID 1
        }
        else{
           
            $leads = Lead::where('assigned_to', Auth::id())->get(); // Fetch all leads assigned to user with ID 1
        }
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
         ]);

            Lead::create([
                ...$validated,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'designation' => $request->designation,
                'source' => $request->source,
                'status' => $request->status ?? 'New',
                'notes' => $request->notes,
                'assigned_to' => $request->assigned_to,
                'created_by' => Auth::id(),
                'follow_up_date' => $request->follow_up_date,
                'reminder_time' => $request->reminder_time,
            ]);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return view('leads.show', [
            'lead' => Lead::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('leads.edit', [
            'lead' => Lead::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         Lead::findOrFail($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'designation' => $request->designation,
            'source' => $request->source,
            'status' => $request->status,
            'notes' => $request->notes,
            'assigned_to' => $request->assigned_to,
            'follow_up_date' => $request->follow_up_date,
            'reminder_time' => $request->reminder_time,
        ]) ;
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Lead::findOrFail($id)->delete() ? 
            redirect()->route('leads.index')->with('success', 'Lead deleted successfully!') :
            redirect()->route('leads.index')->with('error', 'Failed to delete lead.');
    }
}
