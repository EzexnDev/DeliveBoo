<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menuitems';
    
    protected $fillable = [
        "restaurant_id", 'name', 'description', "ingredients", 'price', "isActive"
    ];

    public function options(){
        return $this->belongsToMany('App\Option', 'menuitem_option', 'menuitem_id', 'option_id');
    }
    public function restaurant(){
        return $this->belongsTo('App\Restaurant', 'restaurant_id');
    }
    public function orders(){
        return $this->belongsToMany('App\Order', 'menuitem_order', 'menuitem_id', 'order_id');
    }
}
