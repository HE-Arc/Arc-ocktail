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
            'unit' => 'cl'
        ]);
        DB::table('units')->insert([
            'unit' => 'cs'
        ]);
        DB::table('units')->insert([
            'unit' => 'cc'
        ]);
    }
}
