<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\orderValidate;
use App\Order;
use Braintree;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $totalPrice = $request->totalPrice;
        $itemsId = $request->itemsId;
        $itemsQty = $request->itemsQty;
        
        Session::put('totalPrice',$totalPrice);
        Session::put('itemsId',$itemsId);
        Session::put('itemsQty',$itemsQty);

        return view('order',compact('totalPrice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(orderValidate $request)
    {
        //VALIDAZIONE REQUEST ORDINE
        $validated = $request->validated();
        $totalPrice = Session::has("totalPrice") ? round(Session::get("totalPrice"),2,PHP_ROUND_HALF_UP) : null;
        $itemsId = Session::has("itemsId") ? explode(",",Session::get("itemsId")) : null;
        $itemsQty = Session::has("itemsQty") ? explode(",",Session::get("itemsQty")) : null;

        //dd($itemsId,$itemsQty);

        $newOrder = new Order();

        $newOrder->name = $validated['orderName'];
        $newOrder->surname = $validated['orderSurname'];
        $newOrder->address = $validated['orderAddress'];
        $newOrder->phone = $validated['orderPhone'];
        $newOrder->email = $validated['orderEmail'];
        $newOrder->notes = $validated['orderNotes'];
        $newOrder->totalPrice = $totalPrice;
        $newOrder->isPayed = false;

        $newOrder->save();
        Session::put('newOrder',$newOrder);

        foreach($itemsId as $key => $it){
            $newOrder->menuItems()->attach($it,['quantity' => $itemsQty[$key]]);
        }
        
        

        //dd($newOrder);

        //RIMANDO A VIEW DI CHECKOUT
        $gateway = new Braintree\Gateway([
            'environment' => "sandbox",             
           'merchantId' => "4fpx4bjjrdctfz3r",             
           'publicKey' => "r8hvpqpv3xgpv47j",             
           'privateKey' => "a44196b0529e5a5dc1695e3d8336f933"
        ]);

        $token = $gateway->ClientToken()->generate();
        
        //dd($request,$totalPrice);
        return view('checkout', compact('token','totalPrice'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
