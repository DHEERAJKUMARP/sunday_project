<?php

namespace App\Http\Controllers\office_time;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class dashboardController extends Controller
{
    public function index()
    {
        // Return the view with the correct path
        return view('office_time.dashboard');
    }
    //getting the data
}
