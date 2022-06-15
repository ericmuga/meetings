<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Member,Guest, Meeting, Meetings};

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard',['members'=>Member::count(),'guests'=>Guest::count(),'meetings'=>Meeting::count()]);
    }
}
