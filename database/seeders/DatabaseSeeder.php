<?php

namespace Database\Seeders;

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
    }
}
