<?php

use Illuminate\Database\Seeder;

use App\MenuItem;
use App\Order;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class MenuItemsOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $menuitems = MenuItem::all();
        $orders = Order::all();

        foreach($menuitems as $menuitem){

            for($i=1; $i<= $faker->numberBetween(1,$orders->count()); $i++){
                //uso l'indice del for come identificativo del tag
                DB::table('menuitem_order')->insert([
                    //inserisco chiavi esterne da associare
                    'menuitem_id' => $menuitem->id,
                    'order_id' => $i,
                    'quantity' => $faker->numberBetween($min=1 , $max=10),
                ]);

            };

        }
    }
}
