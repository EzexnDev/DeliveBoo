<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CuisineTypeSeeder::class);
        $this->call(OptionsSeeder::class);
        $this->call(RestaurantsSeeder::class);
        $this->call(MenuItemOptionsSeeder::class);
        $this->call(MenuItemsSeeder::class);
        $this->call(CuisinTypesRestaurantsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(MenuItemsOrdersSeeder::class);

    }
}
