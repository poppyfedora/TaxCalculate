<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('items')->insert([
            [
                'name' => 'Big Mac',
                'tax_id' => 1,
                'price' => 1000
            ],
            [
                'name' => 'Lucky Stretch',
                'tax_id' => 2,
                'price' => 1000
            ],
            [
                'name' => 'Movie',
                'tax_id' => 3,
                'price' => 150
            ]
        ]);
    }
}
