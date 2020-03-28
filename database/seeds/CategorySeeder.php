<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'code' => 'GEN001',
            'name' => 'General',
            'description' => 'Productos Generales',
            'iva' => 0.19,
        ]);

        DB::table('categories')->insert([
            'code' => 'EXE001',
            'name' => 'Exento',
            'description' => 'Productos exentos del impuesto',
            'iva' => 0,
        ]);

        DB::table('categories')->insert([
            'code' => 'RED001',
            'name' => 'Reducido',
            'description' => 'Productos com impuesto reducido',
            'iva' => 0.05,
        ]);
    }
}
