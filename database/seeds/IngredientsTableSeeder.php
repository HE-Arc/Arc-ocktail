<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert([
            ['name' => 'Rhum',
            'alcohol_degree' => '37.5',
            'categorie_id' => '1',
            'unit_id' => '1'],

            ['name' => 'Whiskey',
            'alcohol_degree' => '40',
            'categorie_id' => '1',
            'unit_id' => '1'],

            ['name' => 'Vodka',
            'alcohol_degree' => '40',
            'categorie_id' => '1',
            'unit_id' => '1'],

            ['name' => 'Suze',
            'alcohol_degree' => '40',
            'categorie_id' => '1',
            'unit_id' => '1'],

            ['name' => 'Jus de mangue',
            'alcohol_degree' => '0',
            'categorie_id' => '2',
            'unit_id' => '1'],

            ['name' => 'Jus de kiwi',
            'alcohol_degree' => '0',
            'categorie_id' => '2',
            'unit_id' => '1'],

            ['name' => 'Lime',
            'alcohol_degree' => '0',
            'categorie_id' => '3',
            'unit_id' => '1'],

            ['name' => 'Menthe',
            'alcohol_degree' => '0',
            'categorie_id' => '3',
            'unit_id' => '1']
        ]);
    }
}
