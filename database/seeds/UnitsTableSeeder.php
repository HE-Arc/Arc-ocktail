<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            ['unit' => 'cl'],
            ['unit' => 'cs'],
            ['unit' => 'cc'],
            ['unit' => 'pièces'],
            ['unit' => 'feuilles'],
            ['unit' => 'pincées'],
        ]);
    }
}
