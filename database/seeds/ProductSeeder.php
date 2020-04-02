<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(\App\Product::class, 15)->create();
    }
}
