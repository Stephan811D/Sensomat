<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Automat;

class AutomatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Automat::factory()->count(3)->create();
    }
}
