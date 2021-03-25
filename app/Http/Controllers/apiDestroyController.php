<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\MenuItem;
use App\CuisineType;
use Illuminate\Http\Request;

class apiDestroyController extends Controller
{
    public function delete(Request $request){
        $data = $request->all();
        $restaurant = Restaurant::find($data['id']);
        $menuitems = MenuItem::where('restaurant_id','=',$restaurant->id)->get();

        foreach($menuitems as $menuitem){
            $menuitem->options()->detach();
            $menuitem->orders()->detach();
        }
      
        $restaurant->menuItems()->delete();
        $restaurant->cuisineType()->detach();
        $restaurant->delete();

        return true;
    }
}
