<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TestController;
use App\Models\Enquiries;
use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enquiries::factory()->count(20)->create();
        $syncBranch = new BranchController(); $syncBranch->syncRequest();
        $syncCity   = new CityController();   $syncCity->syncRequest();
        $syncTest   = new TestController();   $syncTest->syncRequest();
    }
}
