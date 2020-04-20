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
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(StakeholderSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
