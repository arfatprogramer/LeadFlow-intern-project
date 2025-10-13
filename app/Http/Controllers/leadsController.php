<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\LeadQualifiedNotification;
use App\Notifications\tesst;
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
            $leads = Lead::orderBy('updated_at','desc')->get(); // Fetch all leads assigned to user with ID 1
        }
        else{
           
            $leads = Lead::where('assigned_to', Auth::id())->orderBy('updated_at','desc')->get(); // Fetch all leads assigned to user with ID 1
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

    public function OpenUpdateFollowUp($id)
    {
        $lead = Lead::findOrFail($id);
        return view('leads.update_follow_up', compact('lead'));
    }

    public function updateFollowUp(Request $request, $id)
    {
        $request->validate([
            'follow_up_date' => 'required|date',
            'reminder_time' => 'nullable|',
            'status' => 'required|string',
            'notes' => 'required|string',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->follow_up_date = $request->follow_up_date;
        $lead->reminder_time = $request->reminder_time;
        $lead->status = $request->status;
        $lead->notes = $request->notes;
        $lead->save();

        return redirect()->route('leads.show',$id)->with('success', 'Follow-up details updated successfully.');
    }

}
