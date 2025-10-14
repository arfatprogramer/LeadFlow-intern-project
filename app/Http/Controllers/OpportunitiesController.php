<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Opportunitie;
use App\Models\User;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $opportunities = Opportunitie::with(['lead', 'user'])->orderBy('updated_at','desc')->paginate(10);
        return view('opportunities.index', compact('opportunities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::all();
        return view('opportunities.create', compact('leads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'value' => 'nullable|numeric',
            'expected_close_date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id',
        ]);
        Opportunitie::create($data);

        return redirect()->route('opportunities.index')->with('success', 'Opportunity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $opportunity = Opportunitie::with(['lead', 'user'])->findOrFail($id);
        
        return view('opportunities.show', compact('opportunity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leads = Lead::all();
        $opportunity= Opportunitie::with(['lead'])->findOrFail($id);
       
        return view('opportunities.edit', compact('opportunity', 'leads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = $request->validate([
            'title' => 'required|string|max:255',
            'stage' => 'required|string',
            'value' => 'nullable|numeric',
            'details' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);
       
        $opportunity = Opportunitie::findOrFail($id);
        $opportunity->update($data);

        return redirect()->route('opportunities.index')->with('success', 'Opportunity updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Opportunitie = Opportunitie::findOrFail($id);
        $Opportunitie->delete();
        return back()->with('success', 'Opportunity deleted.');
    
    }
    
    // for display contats Specife Logs
     public function log($id)
    {
        $opportunity=Opportunitie::with(['activityLogs','lead.activityLogs'])->OrderBy('created_at','desc')->findOrFail($id);
        // return $opportunity;
        $logs=collect();
        if ($opportunity->activityLogs) {
           $logs=$logs->merge($opportunity->activityLogs);
        }
         if ($opportunity->lead && $opportunity->lead->activityLogs) {
           $logs=$logs->merge($opportunity->lead->activityLogs);
        }
        $logName=$opportunity->title;
        return view('show-logs',compact('logs','logName'));
    }
}
