<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Restaurant;
use App\MenuItem;
use App\Order;
use App\Chart;

class StatController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $menuitems = MenuItem::all();
        //ID DA PASSARE CON BUS
        $robberyUserId = 21;
        $robberyRestaurantsId = [8,10];

        $chart = DB::table('menuitem_order')
                    ->join('orders','order_id','=','orders.id')
                    ->join('menuitems','menuitem_id','=','menuitems.id')
                    ->join('restaurants','restaurant_id','=','restaurants.id')
                    ->where('user_id','=',$robberyUserId)
                    ->whereIn('restaurant_id', $robberyRestaurantsId)//['10','37','38']
                    ->select(DB::raw("DISTINCT DATE_FORMAT(orders.created_at,'%Y/%m') AS date"), DB::raw('MAX(orders.totalPrice) AS monthCash'))
                    ->groupBy('date') 
                    ->pluck('monthCash','date')->all();
        
        /* $orders = DB::table('menuitem_order')
                        
                        ->join('orders','order_id','=','orders.id')
                        ->select('order_id as id','name','surname','phone','email','isPayed','totalPrice',DB::raw('SUM(quantity) AS totItem'),'orders.created_at as orderCreate','orders.updated_at as orderPayed')
                        ->groupBY('order_id')
                        ->get(); */

        $orders = DB::table('menuitem_order')
                        ->join('menuitems','menuitem_id','=','menuitems.id')
                        ->join('restaurants','restaurant_id','=','restaurants.id')
                        ->where('user_id','=',$robberyUserId)
                        ->where('restaurant_id','=','10')
                        ->join('orders','order_id','=','orders.id')
                        ->select('order_id as id','orders.name','orders.surname','orders.phone','orders.email','orders.isPayed','orders.totalPrice',DB::raw('SUM(quantity) AS totItem'),'orders.created_at as orderCreate','orders.updated_at as orderPayed')
                        ->groupBY('order_id')
                        ->get();

        
        /* $stats = DB::table('menuitem_order')
                        ->select(DB::raw('SUM(totalPrice) AS monthCash'),DB::raw("DATE_FORMAT(orders.created_at,'%Y/%m') AS date"))
                        ->join('orders','order_id','=','orders.id')
                        ->groupBy('order_id')
                        ->pluck('monthCash','date')->all(); */

        
        return view('restaurants.statistics', compact('restaurants','menuitems','chart','orders'));
    }
}
