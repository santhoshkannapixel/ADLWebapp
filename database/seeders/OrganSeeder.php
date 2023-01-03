<?php

namespace Database\Seeders;

use App\Models\Organs;
use App\Models\Tests;
use Illuminate\Database\Seeder;

class OrganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tests =  Tests::select('*')->whereNotNull('OrganName')->groupBy('OrganName')->pluck('OrganName')->toArray();
        foreach ($Tests as $key => $test) {
            if(!empty($test)) {
                Organs::create([
                    "name" => $test,
                    "order_by" => $key
                ]);
            } 
        }
    }
}