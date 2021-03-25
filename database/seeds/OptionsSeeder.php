<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Option;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Option::class,5)->create();
        $options = ["carne","pesce","vegetariano","vegano","pizza"];

        foreach($options as $option){
            DB::table("options")->insert(["option"=>$option, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        }
    }
}
