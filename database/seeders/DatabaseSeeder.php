<?php

namespace Database\Seeders;

//use App\Models\Product;
//use App\Models\Shaft;

//use App\Models\ProductType;
//use App\Models\Machine;

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
        $this->call(AutomatsTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ShaftsTableSeeder::class);
    }
}
