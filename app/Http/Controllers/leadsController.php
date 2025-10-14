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
        try {
            if (in_array('admin', Auth::user()->role_names)) {  
                $leads = Lead::orderBy('updated_at','desc')->get();
            } else {
                $leads = Lead::where('assigned_to', Auth::id())->orderBy('updated_at','desc')->get();
            }
            return view('leads.index', compact('leads'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching leads: '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('leads.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading create form: '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
            ]);

            return redirect()->route('leads.index')->with('success', 'Lead created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating lead: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return view('leads.show', [
                'lead' => Lead::with('users')->findOrFail($id)
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error displaying lead: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return view('leads.edit', [
                'lead' => Lead::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading edit form: '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $lead = Lead::findOrFail($id)->update([
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
            ]);

            return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating lead: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return Lead::findOrFail($id)->delete() ? 
                redirect()->route('leads.index')->with('success', 'Lead deleted successfully!') :
                redirect()->route('leads.index')->with('error', 'Failed to delete lead.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting lead: '.$e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            Lead::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Selected leads deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting selected leads: '.$e->getMessage()], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;

        if ($ids && $status) {
            Lead::whereIn('id', $ids)->update(['status' => $status]);
            return response()->json(['message' => 'Selected leads updated successfully.']);
        }

        return response()->json(['message' => 'No leads selected or status missing.'], 400);
    }


    public function OpenUpdateFollowUp($id)
    {
        try {
            $lead = Lead::findOrFail($id);
            return view('leads.update_follow_up', compact('lead'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error opening follow-up update: '.$e->getMessage());
        }
    }

    public function updateFollowUp(Request $request, $id)
    {
        try {
            $request->validate([
                'follow_up_date' => 'required|date',
                'status' => 'required|string',
                'notes' => 'required|string',
            ]);

            $lead = Lead::findOrFail($id);
            $lead->follow_up_date = $request->follow_up_date;
            $lead->status = $request->status;
            $lead->notes = $request->notes;
            $lead->save();

            return redirect()->route('leads.show', $id)->with('success', 'Follow-up details updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating follow-up: '.$e->getMessage());
        }
    }

    public function log($id)
    {
        try {
            $lead = Lead::with(['activityLogs','contacts.activityLogs','opportunities.activityLogs'])
                        ->orderBy('created_at','desc')->findOrFail($id);

            $logs = collect();

            if ($lead->activityLogs) {
                $logs = $logs->merge($lead->activityLogs);
            }

            if ($lead->contats && $lead->contats->activityLogs) {
                $logs = $logs->merge($lead->contats->activityLogs);
            }

            if ($lead->opportunities && $lead->opportunities->activityLogs) {
                $logs = $logs->merge($lead->opportunities->activityLogs);
            }

            $logName = $lead->first_name." ".$lead->last_name;
            return view('show-logs', compact('logs', 'logName'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching logs: '.$e->getMessage());
        }
    }

}
