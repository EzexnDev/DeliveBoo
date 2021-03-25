<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable= ['name', 'address', 'description', 'deliveryHours', 'closeDay', 'shortDescription', 'phone', 'city', 'imgUrl'];

    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }

    public function menuItems(){
        return $this->hasMany('App\MenuItem', 'restaurant_id', 'id');
    }

    public function cuisineType(){
        return $this->belongsToMany('App\CuisineType', 'cuisinetype_restaurant', 'restaurant_id', 'cuisinetype_id');
    }
}
