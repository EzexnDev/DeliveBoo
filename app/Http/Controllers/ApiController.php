<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Restaurant;
use App\CuisineType;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function restaurants(Request $request)
    {
        $query = $request->input('queryName');

        $data = Restaurant::with("cuisineType","menuItems","user")->whereHas('cuisineType', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%".$query."%");
        })->get();

        return response()->json($data);
    }

    public function getTypes(Request $request)
    {
        $query = $request->input('query');

        $data = Restaurant::with("cuisineType","menuItems","user")->whereHas('cuisineType', function ($q) use ($query) {
            $q->whereIn('type', $query);
        })->get();

        return response()->json($data);
    }
   
}
