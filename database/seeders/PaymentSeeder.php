<?php

namespace Database\Seeders;

use App\Models\PaymentConfig;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentConfig::create([
            'gateWayName' => 'Rayzorpay',
            'payKeyId' => 'rzp_live_cannuAHYYLsJIo',
            'paySecretKey' => 'zRG7TgniW08KfZ1FR8lVHEzv'
        ]);
    }
}
