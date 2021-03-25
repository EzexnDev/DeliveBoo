<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable= ['order_id'];

    public function menuItems(){
        return $this->belongsToMany('App\MenuItem', 'menuitem_order', 'order_id', 'menuitem_id');
    }
}
