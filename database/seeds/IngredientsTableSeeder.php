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
            'name' => 'Rhum',
            'alcohol_degree' => '37.5',
            'categorie_id' => '1',
            'unit_id' => '1',
        ]);
        DB::table('ingredients')->insert([
            'name' => 'Whiskey',
            'alcohol_degree' => '40',
            'categorie_id' => '1',
            'unit_id' => '1',
        ]);
        DB::table('ingredients')->insert([
            'name' => 'Vodka',
            'alcohol_degree' => '40',
            'categorie_id' => '1',
            'unit_id' => '1',
        ]);
    }
}
