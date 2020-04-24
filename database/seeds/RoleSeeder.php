<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'basic',
            'description' => 'initial user basic permissions role',
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'user admin permissions role',
        ]);
        DB::table('roles')->insert([
            'name' => 'superAdmin',
            'description' => 'Full permissions role',
        ]);
    }
}
