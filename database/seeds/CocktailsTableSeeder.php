<?php

use Illuminate\Database\Seeder;

class CocktailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cocktails')->insert([
            'name' => 'Thé Oolong',
            'alcohol_degree' => '40',
            'recipe' => "Versez l'équivalent de 90% du verre en vodka, puis 10% en Whiskey."
        ]);
    }
}
