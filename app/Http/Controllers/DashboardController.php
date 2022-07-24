<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Member,Guest, Meeting, Meetings};
use Gate;
use Illuminate\Auth\Access\Gate as AccessGate;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(request()->user()->can('admin'));

        switch (request()->user()->user_type->name)
        {
            case 'Admin':
                $this->authorize('admin');
                //  Gate::allows('admin');
                 return inertia('Dashboard',['members'=>Member::count(),'guests'=>Guest::count(),'meetings'=>Meeting::count()]);
                break;
            case 'Member':
                 return inertia('DashboardMember',['members'=>Member::count(),'guests'=>Guest::count(),'meetings'=>Meeting::count()]);
                break;
             case 'Guest':
                 return inertia('DashboardGuest',['members'=>Member::count(),'guests'=>Guest::count(),'meetings'=>Meeting::count()]);
                break;

            default:
                # code...
                break;
        }

    }
}
