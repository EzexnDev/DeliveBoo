<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    protected $table = 'cuisinetypes';

    public function restaurant(){
        return $this->belongsToMany('App\Restaurant', 'cuisinetype_restaurant', 'cuisinetype_id', 'restaurant_id');
    }
}


