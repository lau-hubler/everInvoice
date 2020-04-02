<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(StakeholderSeeder::class);
    }
}
