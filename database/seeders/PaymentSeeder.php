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
            'payKeyId' => 'rzp_test_S5bQihn0KDELkq',
            'paySecretKey' => 'MZ2gsjti999NSHqRS3lY9TjB'
        ]);
    }
}
