<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index()
    {

        //this page shows the various administrative tasks
         /**
          *  Zoom Setup
             Grading Rules
             Member retirement
             Guest Promotions
          */
        return inertia('Admin/Index');
    }
}
