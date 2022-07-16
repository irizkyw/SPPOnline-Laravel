<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user()->id;
        return view('dashboard.dashboard',compact('user'));
    }
}
