<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Load Home Page with Website Details
    public function index(){
        $websites = Website::all();
        return view('frontend.home', compact('websites'));
    }
}
