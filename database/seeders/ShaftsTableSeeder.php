<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Automat;
use App\Models\Shaft;

class ShaftsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shaft::factory()->count(20)->create()->each(function($shaft, $shaftKey){
            $shaft->update(['shaft_id'=>$shaftKey+1]);
            $shaft->update(['automat_id'=>'1']);
        });

        Shaft::factory()->count(20)->create()->each(function($shaft, $shaftKey){
            $shaft->update(['shaft_id'=>$shaftKey+1]);
            $shaft->update(['automat_id'=>'2']);
        });

        Shaft::factory()->count(20)->create()->each(function($shaft, $shaftKey){
            $shaft->update(['shaft_id'=>$shaftKey+1]);
            $shaft->update(['automat_id'=>'3']);
        });
        /*
        $automats = Automat::all();
        $automats->each(function ($collection, $key) {
            Shaft::factory()->count(20)->create()->each(function($shaft, $shaftKey){
                $shaft->update(['shaft_id'=>$shaftKey+1]);
                $shaft->update(['automat_id'=>$key]);
            });
        });
        */
    }
}
