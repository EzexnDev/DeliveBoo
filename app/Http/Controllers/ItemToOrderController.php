<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MenuItem;
use App\Order;
use App\Cart;
use Session;

class ItemToOrderController extends Controller
{
    public function getAddToCart(Request $request){
        $menuitem = MenuItem::find($request->id);
        $oldCart = Session::has("cart") ? Session::get("cart"): null;
        $cart = new Cart($oldCart);
        $cart->add($menuitem, $menuitem->id);
        $request->session()->put("cart", $cart);
        
        return back();
    }

    public function getReduceByOne(Request $request) {
        $id = $request->id;
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put("cart", $cart);
        } else {
            Session::forget("cart");
        }
        
        return back();
    }

    public function getRemoveItem(Request $request) {
        $id = $request->id;
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put("cart", $cart);
        }
        else {
            Session::forget("cart");
        }
        
        return back();
    }

    public function checkCart(Request $request)
    {   dd($request);
        Session::put("cart",$cart);
        
    }


    //_______________________________________________________________
    // private $items;

    // public function __construct() {
    //     $this->items = [];
    // }

    // public function add(Request $request) 
    // {
    //     $el = [
    //         'id' => $request->id,
    //         'quantity' => $request->quantity
    //     ];
    //     array_push($this->items, $el);
    //     //dd($this->items);
    //     //return back();
    //     return view('test', compact($items));
    // }

    // public function store(Request $request) 
    // {
    //     dd($request);
    //     $menuitem = MenuItem::find($request->id);
    //     $order = new Order;
    //     $order->totalPrice += $menuitem->price * $request->quantity;
    //     $order->isPayed = 0;
    //     $order->notes = '';
    //     $order->name = 'PROVA';
    //     $order->surname = '';
    //     $order->address = '';
    //     $order->email = '';
    //     $order->phone = '';
    //     $order->save();
    //     $order->menuItems()->attach($menuitem, [
    //         'menuitem_id' => $menuitem->id,
    //         'order_id' => $order->id,
    //         'quantity' => $request->quantity,
    //         ]);
    //     return redirect()->route('restaurants.index');
    // }
}

