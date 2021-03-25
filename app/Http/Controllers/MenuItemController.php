<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\MenuItem;
use App\Http\Requests\menuItemValidate;
use App\Restaurant;
use App\Option;
use Illuminate\Http\Request;
use Session;

class MenuItemController extends Controller
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
        // $restaurant = session()->get('restaurant');
        
        $restaurantId = $request->restaurantId;
        //dd($restaurantId);
        Session::put('restaurantId',$restaurantId);
        $options = Option::all();
        return view('items.create',compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(menuItemValidate $request)
    {
        $validated = $request->validated();
        $restaurantId = Session::get('restaurantId');
        //dd($restaurantId);
        $newMenuItem = new MenuItem();

        $newMenuItem->name = $validated['menuItemName'];
        $newMenuItem->description = $validated['menuItemDescription'];
        //$newMenuItem->ingredients = $validated['menuItemIngredients'];
        $newMenuItem->price = $validated['menuItemPrice'];
        $newMenuItem->isActive = 1;
        $newMenuItem->isDeleted = 0;
        $newMenuItem->restaurant()->associate($restaurantId);
        $newMenuItem->save();
        
        $newMenuItem->options()->attach($validated['options']);
        
        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuitem)
    {
       //dd($menuitem);
         /* $menuItem = MenuItem::find($id); */
        $options = Option::all();
        return view('items.edit',compact('menuitem','options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(menuItemValidate $request, $id)
    {
        
        $validated = $request->validated();
        $menuitem = MenuItem::find($id);

        $menuitem->update([
            'name' => $validated['menuItemName'],
            'description' => $validated['menuItemDescription'],
            //'ingredients' => $validated['menuItemIngredients'],
            'price' => $validated['menuItemPrice'],
            'isActive' => 1,
            'isDeleted' => 0,
        ]);

        $menuitem->options()->sync($validated['options']);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuitem)
    {
        dd($menuitem);
        $menuitem = MenuItem::find($id);
        $menuitem['isDeleted'] = 1;

        $menuitem->save();
       /*  $menuItem->options()->detach();
        $menuItem->orders()->detach();
        $menuItem->delete(); */
        
        return redirect()->back();
    }

    public function toggle(MenuItem $menuitem)
    {
        
        //dd($menuitem);
        $a = $menuitem['isActive'];
        $menuitem['isActive'] = !$a;
        $menuitem->save();

        return redirect()->back();
    }

    public function delete(MenuItem $menuitem)
    {
        //dd($menuitem);
        
        $menuitem['isDeleted'] = 1;

        $menuitem->save();
       /*  $menuItem->options()->detach();
        $menuItem->orders()->detach();
        $menuItem->delete(); */
        
        return redirect()->back();
    }
}
