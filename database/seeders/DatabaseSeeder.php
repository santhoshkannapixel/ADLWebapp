<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TestController;
use App\Models\Enquiries;
use App\Models\PaymentConfig;
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
            UserAndRolesSeeder::class,
            NewsAndEventSeeder::class,
            ApiLocationSeeder::class
        ]);
        PaymentConfig::create([
            'gateWayName' => 'Rayzorpay',
            'payKeyId' => 'rzp_test_S5bQihn0KDELkq',
            'paySecretKey' => 'MZ2gsjti999NSHqRS3lY9TjB'
        ]);
        Enquiries::factory()->count(20)->create();
        $syncBranch = new BranchController(); $syncBranch->syncRequest();
        $syncCity   = new CityController();   $syncCity->syncRequest();
        $syncTest   = new TestController();   $syncTest->syncRequest(); 
    }
}
