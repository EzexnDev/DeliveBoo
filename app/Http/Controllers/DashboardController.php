<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;
use App\MenuItem;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $menuitems = MenuItem::all();
        
        return view('restaurants.dashboard', compact('restaurants','menuitems'));
    }
}
