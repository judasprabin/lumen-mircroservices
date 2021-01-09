<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::factory()->times(50)->create();
    }
}
