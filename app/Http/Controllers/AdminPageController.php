<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    /**
     *  show admin dashboard
     */
    public function showDashboard()
    { 
        return view('admin.pages.dashboard');
    }
}
