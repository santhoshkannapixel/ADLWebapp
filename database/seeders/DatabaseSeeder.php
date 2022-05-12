<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TestController;
use App\Models\Enquiries;
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
        $this->call([
            UserSeeder::class, 
        ]);
        
        Enquiries::factory()->count(45)->create();

        $syncBranch = new BranchController(); $syncBranch->syncRequest();
        $syncCity   = new CityController();   $syncCity->syncRequest();
        $syncTest   = new TestController();   $syncTest->syncRequest();
    }
}
