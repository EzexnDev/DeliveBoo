<?php

use Illuminate\Database\Seeder;

use App\Restaurant;
use Faker\Generator as Faker;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // factory(Restaurant::class,20)->create();
        $names = [
            'Pizzeria da Othman', 'Pizzeria da Gabu', 'Pizzeria da Simo', 'Pizzeria da Andre', 'Pizzeria da Gian',
            'Trattoria del Boo', 'Osteria numero 1000', 'La Locanda del Viandante', 'La Pinta', 'La Taverna di Bool',
            'Boolger King','KFPollo','Mc Boolean', 'M** BUN', 'Burger Pub',
            'Pechino Restaurant', 'BruceLee Restaurant', 'Jacky Chan Restaurant', 'Asian Restaurant', 'ju Fu Wok',
            'Hisashi', 'Nigiri Kung Fu', 'Chirashi Mix', 'Sakura', 'Cosplay&Sushi',
            'Maharaja', 'koothrappali Indian', 'Taste of India', 'Namaste India', 'Ganesh',
            'America Graffiti', 'West End', 'Steak House', 'Donald&Joe', "That's Othman"
        ];

        for ($i=0; $i < count($names); $i++) {

            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $faker->numberBetween($min = 1, $max = 20 );
            $new_restaurant->address = $faker->streetAddress();
            $new_restaurant->description = 'Hai fame? Scegli noi!';
            // $new_restaurant->imgUrl = 'https://picsum.photos/300/200?random=' . $faker->unique()->numberBetween($min = 1, $max = 800);
            $new_restaurant->imgUrl = '/img/restaurants/'.$i.'.jpg';
            $new_restaurant->isActive = true;
            $new_restaurant->deliveryHours = '12:00 / 23:00';
            $new_restaurant->closeDay = $faker->dayOfWeek();
            if($i < 15){
                $new_restaurant->shortDescription = 'In 15 min a casa tua!';
            } else {
                $new_restaurant->shortDescription = 'In ' . $i . ' min a casa tua!';
            }
            $new_restaurant->name = $names[$i];
            $new_restaurant->phone= $faker->phoneNumber();
            $new_restaurant->city= 'Roma';

            $new_restaurant->save();
        }
    }
}
