<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\CuisineType;

class CuisineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["pizza","italiano","hamburger","cinese","giapponese","indiano","americano"];

        foreach($types as $type){
            DB::table("cuisinetypes")->insert(["type"=>$type, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        }
    }
}
