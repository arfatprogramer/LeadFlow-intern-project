<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Opportunitie;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    { 
        return view('dashboard.index', [
            'leadsCount' => Lead::count(),
            'contactsCount' => Contact::count(),
            'opportunitiesCount' => Opportunitie::count(),
            'recentLeads' => Lead::with('users')->latest()->take(5)->get(),
            'recentContacts' => Contact::latest()->take(5)->get(),
            'recentOpportunities' => Opportunitie::latest()->take(5)->get(),
        ]);
    }
}
