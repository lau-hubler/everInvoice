<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'code' => 'category.index',
            'description' => 'User can see list of categories',
        ]);
        DB::table('permissions')->insert([
            'code' => 'category.store',
            'description' => 'User can create a new category',
        ]);
        DB::table('permissions')->insert([
            'code' => 'category.update',
            'description' => 'User can update a category',
        ]);
        DB::table('permissions')->insert([
            'code' => 'category.show',
            'description' => 'User can see specific category',
        ]);
        DB::table('permissions')->insert([
            'code' => 'category.delete',
            'description' => 'User can delete a category',
        ]);
    }
}
