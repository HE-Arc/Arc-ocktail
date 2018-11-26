<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Alcools'],
            ['name' => 'Sodas'],
            ['name' => 'Sirop'],
            ['name' => 'Fruits'],
            ['name' => 'Plantes'],
            ['name' => 'Autre']
        ]);
    }
}
