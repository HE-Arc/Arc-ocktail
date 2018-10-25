<?php

use Illuminate\Database\Seeder;

class QuantitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quantities')->insert([
            ['quantity' => '27',
            'cocktail_id' => '1',
            'ingredient_id' => '3'],

            ['quantity' => '3',
            'cocktail_id' => '1',
            'ingredient_id' => '2']
        ]);
    }
}
