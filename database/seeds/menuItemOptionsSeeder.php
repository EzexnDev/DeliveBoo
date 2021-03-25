<?php

use Illuminate\Database\Seeder;

use App\MenuItem;
use App\Option;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class MenuItemOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $menuitems = MenuItem::all();
        $options = Option::all();

        foreach($menuitems as $menuitem){

            for($i=1; $i<= $faker->numberBetween(1,$options->count()); $i++){
                //uso l'indice del for come identificativo del tag
                DB::table('menuitem_option')->insert([
                    //inserisco chiavi esterne da associare
                    'menuitem_id' => $menuitem->id,
                    'option_id' => $i,
                ]);

            };

        }
    }
}
