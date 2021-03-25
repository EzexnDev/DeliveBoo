<?php

use Illuminate\Database\Seeder;

use App\Restaurant;
use App\CuisineType;

use Faker\Generator as Faker;

use Illuminate\Support\Facades\DB;

class CuisinTypesRestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = Restaurant::all();
        $cuisinetypes = CuisineType::all();

        for ($i=0; $i < $restaurants->count(); $i++) { 
            if($i < 5){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 1,
                ]);
            } else if($i < 10){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 2,
                ]);
            } else if($i < 15){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 3,
                ]);
            }else if($i < 20){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 4,
                ]);
            }else if($i < 25){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 5,
                ]);
            }else if($i < 30){
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 6,
                ]);
            }else{
                DB::table('cuisinetype_restaurant')->insert([
                    'restaurant_id' => $restaurants[$i]->id,
                    'cuisinetype_id' => 7,
                ]);
            }
        }
    }
}