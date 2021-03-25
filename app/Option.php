<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    public function menuItems(){
        return $this->belongsToMany('App\MenuItems', 'menuitem_option', 'option_id', 'menuitem_id');
    }
}
