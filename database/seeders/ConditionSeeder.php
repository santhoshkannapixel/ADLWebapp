<?php

namespace Database\Seeders;

use App\Models\Conditions;
use App\Models\Tests;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tests =  Tests::select('*')->whereNotNull('HealthCondition')->groupBy('HealthCondition')->pluck('HealthCondition')->toArray();
        foreach ($Tests as $key => $test) {
            if(!empty($test)) {
                Conditions::create([
                    "name" => str_replace('\r\n', "",$test),
                    "order_by" => $key
                ]); 
            }
        }
    }
}
