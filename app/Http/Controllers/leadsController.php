<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\LeadQualifiedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class leadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (in_array('admin', Auth::user()->role_names)) {  
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
            'lead' => Lead::with('users')->findOrFail($id)
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
         $lead=Lead::findOrFail($id)->update([
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

    public function bulkDestroy(Request $request)
    {
        $ids = $request->ids; // Assuming 'ids' is an array of lead IDs to delete
        Lead::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Selected leads deleted successfully.']);
    }
    public function convert(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        // Create an opportunity based on the lead details
        $opportunity = $lead->opportunities()->create([
            'title' => $lead->company ? "Opportunity for {$lead->company}" : "Opportunity for {$lead->first_name} {$lead->last_name}",
            'value' => $request->value,
            'stage' => 'Interested', // Initial stage
            'details' => $request->details,
            'assigned_to' => $lead->assigned_to,
        ]);

        // Optionally, you can change the lead status to 'Converted'
        $lead->update(['status' => 'Converted']);
        return redirect()->route('opportunities.show', $opportunity->id)->with('success', 'Lead converted to opportunity successfully!');
    }
}
