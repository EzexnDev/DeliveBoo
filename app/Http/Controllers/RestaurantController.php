<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\restaurantValidate;

use App\Restaurant;

use App\MenuItem;
use App\CuisineType;
use App\Cart;
use Session;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        $menuitems = MenuItem::all();
        $cuisineTypes = CuisineType::all();
        
        return view('home', compact('restaurants','menuitems','cuisineTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuisineTypes = CuisineType::all();
        return view('restaurants.create',compact('cuisineTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(restaurantValidate $request)
    {   
        $validated = $request->validated();
        
        $newRestaurant = new Restaurant();

        $newRestaurant->name = $validated['restaurantName'];
        $newRestaurant->address = $validated['restaurantAddress'];
        $newRestaurant->description = $validated['restaurantDescription'];
        /* $newRestaurant->imgUrl = $validated['restaurantImgUrl']; */
        $newRestaurant->isActive = 1;
        $newRestaurant->deliveryHours = $validated['restaurantDeliveryHours'];
        $newRestaurant->closeDay = $validated['restaurantCloseDay'];
        $newRestaurant->shortDescription = $validated['restaurantShortDescription'];
        $newRestaurant->phone = $validated['restaurantPhone'];
        $newRestaurant->city = $validated['restaurantCity'];

        //default image
        $newRestaurant->imgUrl = "/storage/uploads/default.jpg";
        //config/filesystem.php -> 'links' => ['link_path' => 'public_path']
        //php artisan storage:link
        if($request->file('restaurantImgUrl')){
            $imagePath = $request->file('restaurantImgUrl');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('restaurantImgUrl')->storeAs('uploads',$imageName,'public');
            $newRestaurant->imgUrl = "/storage/" . $path ;
        }

        
        $newRestaurant->user()->associate(Auth::user());
        $newRestaurant->save();

        $newRestaurant->cuisineType()->attach($validated['cuisinetypes']);
        /* $newRestaurant->cuisineType()->attach($test[0]); */

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Restaurant $restaurant)
    {
        $menuitems = MenuItem::all();
        $request->session()->put('restaurant', $restaurant);
        $cart = Session::get("cart");
        if($cart){
            $keys = array_keys($cart->items);
            if($cart->items[$keys[0]]['item']['restaurant_id'] != $restaurant->id){
                $cart = Session::forget("cart");
            }
        }

        return view('restaurants.show',compact('restaurant','menuitems','cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if(Auth::id() == $restaurant->user_id) {
            $cuisineTypes = CuisineType::all();
            return view('restaurants.edit',compact('restaurant','cuisineTypes'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(restaurantValidate $request, Restaurant $restaurant)
    {   
        
        //raccolgo dati validati
        $validated = $request->validated();
        /* dd($validated); */
        $restaurant->update([
            'name' => $validated['restaurantName'],
            'address' => $validated['restaurantAddress'],
            'description' => $validated['restaurantDescription'],
            /* 'imgUrl' => '', */
            'deliveryHours' => $validated['restaurantDeliveryHours'],
            'closeDay' => $validated['restaurantCloseDay'],
            'shortDescription' => $validated['restaurantShortDescription'],
            'phone' => $validated['restaurantPhone'],
            'city' => $validated['restaurantCity'],
        ]);

        //config/filesystem.php -> 'links' => ['link_path' => 'public_path']
        //php artisan storage:link
        if($request->file('restaurantImgUrl')){
            $imagePath = $request->file('restaurantImgUrl');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('restaurantImgUrl')->storeAs('uploads',$imageName,'public');
            $restaurant->update([
                'imgUrl' => "/storage/" . $path,
            ]);
        }

        

        $restaurant->cuisineType()->sync($validated['cuisinetypes']);

        return redirect()->route('dashboard', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        dd($restaurant);
        // eliminare option e order
        $restaurant = Restaurant::find($id);
        $menuitems = MenuItem::where('restaurant_id','=',$restaurant->id)->get();

        foreach($menuitems as $menuitem){
            $menuitem->options()->detach();
            $menuitem->orders()->detach();
        }
      
        $restaurant->menuItems()->delete();
        $restaurant->cuisineType()->detach();
        $restaurant->delete();

        return redirect()->route('dashboard');
    }
}
