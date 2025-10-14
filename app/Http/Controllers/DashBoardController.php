<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Opportunitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
   public function index()
    { 
        try {
            $user = Auth::user();
            $isAdmin = in_array('admin', $user->role_names);
            
            if ($isAdmin) {
                // Admin → See all data
                $leadsCount = Lead::count();
                $contactsCount = Contact::count();
                $opportunitiesCount = Opportunitie::count();
                
                $recentLeads = Lead::with('users')->latest()->take(5)->get();
                $recentContacts = Contact::latest()->take(5)->get();
                $recentOpportunities = Opportunitie::latest()->take(5)->get();
            } else {
                // Non-admin → See only assigned data
                $leadsCount = Lead::where('assigned_to', $user->id)->count();
                $contactsCount = Contact::where('assigned_to', $user->id)->count();
                $opportunitiesCount = Opportunitie::where('user_id', $user->id)->count();
                
                $recentLeads = Lead::with('users')->where('assigned_to', $user->id)->latest()->take(5)->get();
                $recentContacts = Contact::where('assigned_to', $user->id)->latest()->take(5)->get();
                $recentOpportunities = Opportunitie::where('user_id', $user->id)->latest()->take(5)->get();
            }
            
            return view('dashboard.index', [
                'leadsCount' => $leadsCount,
                'contactsCount' => $contactsCount,
                'opportunitiesCount' => $opportunitiesCount,
                'recentLeads' => $recentLeads,
                'recentContacts' => $recentContacts,
                'recentOpportunities' => $recentOpportunities,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Error loading dashboard: '.$e->getMessage());
        }
    }

}
