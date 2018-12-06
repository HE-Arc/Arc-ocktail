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
            ['quantity' => '4',
            'cocktail_id' => '1',
            'ingredient_id' => '1'],
            ['quantity' => '0.5',
            'cocktail_id' => '1',
            'ingredient_id' => '2'],
            ['quantity' => '8',
            'cocktail_id' => '1',
            'ingredient_id' => '3'],
            ['quantity' => '2',
            'cocktail_id' => '1',
            'ingredient_id' => '4'],
            ['quantity' => '1',
            'cocktail_id' => '1',
            'ingredient_id' => '5'],

            ['quantity' => '4',
            'cocktail_id' => '2',
            'ingredient_id' => '1'],
            ['quantity' => '6',
            'cocktail_id' => '2',
            'ingredient_id' => '6'],
            ['quantity' => '6',
            'cocktail_id' => '2',
            'ingredient_id' => '7'],
            ['quantity' => '2',
            'cocktail_id' => '2',
            'ingredient_id' => '4'],

            ['quantity' => '6',
            'cocktail_id' => '3',
            'ingredient_id' => '8'],
            ['quantity' => '1',
            'cocktail_id' => '3',
            'ingredient_id' => '2'],
            ['quantity' => '1',
            'cocktail_id' => '3',
            'ingredient_id' => '4'],

            ['quantity' => '4',
            'cocktail_id' => '4',
            'ingredient_id' => '9'],
            ['quantity' => '2',
            'cocktail_id' => '4',
            'ingredient_id' => '10'],
            ['quantity' => '2',
            'cocktail_id' => '4',
            'ingredient_id' => '11'],

            ['quantity' => '3',
            'cocktail_id' => '5',
            'ingredient_id' => '12'],
            ['quantity' => '1',
            'cocktail_id' => '5',
            'ingredient_id' => '13'],
            ['quantity' => '1',
            'cocktail_id' => '5',
            'ingredient_id' => '14'],
            ['quantity' => '4',
            'cocktail_id' => '5',
            'ingredient_id' => '6'],
            ['quantity' => '4',
            'cocktail_id' => '5',
            'ingredient_id' => '15'],

            ['quantity' => '4',
            'cocktail_id' => '6',
            'ingredient_id' => '12'],
            ['quantity' => '1',
            'cocktail_id' => '6',
            'ingredient_id' => '10'],
            ['quantity' => '4',
            'cocktail_id' => '6',
            'ingredient_id' => '15'],
            ['quantity' => '1',
            'cocktail_id' => '6',
            'ingredient_id' => '2'],

            ['quantity' => '3',
            'cocktail_id' => '7',
            'ingredient_id' => '1'],
            ['quantity' => '3',
            'cocktail_id' => '7',
            'ingredient_id' => '16'],
            ['quantity' => '4',
            'cocktail_id' => '7',
            'ingredient_id' => '6'],
            ['quantity' => '4',
            'cocktail_id' => '7',
            'ingredient_id' => '17'],
            ['quantity' => '1',
            'cocktail_id' => '7',
            'ingredient_id' => '18'],

            ['quantity' => '6',
            'cocktail_id' => '8',
            'ingredient_id' => '1'],
            ['quantity' => '4',
            'cocktail_id' => '8',
            'ingredient_id' => '11'],
            ['quantity' => '2',
            'cocktail_id' => '8',
            'ingredient_id' => '4'],

            ['quantity' => '4',
            'cocktail_id' => '9',
            'ingredient_id' => '12'],
            ['quantity' => '2',
            'cocktail_id' => '9',
            'ingredient_id' => '1'],
            ['quantity' => '1',
            'cocktail_id' => '9',
            'ingredient_id' => '19'],
            ['quantity' => '1',
            'cocktail_id' => '9',
            'ingredient_id' => '20'],
            ['quantity' => '1',
            'cocktail_id' => '9',
            'ingredient_id' => '21'],

            ['quantity' => '2',
            'cocktail_id' => '10',
            'ingredient_id' => '22'],
            ['quantity' => '2',
            'cocktail_id' => '10',
            'ingredient_id' => '23'],
            ['quantity' => '2',
            'cocktail_id' => '10',
            'ingredient_id' => '24'],
            ['quantity' => '2',
            'cocktail_id' => '10',
            'ingredient_id' => '25'],
        ]);
    }
}
