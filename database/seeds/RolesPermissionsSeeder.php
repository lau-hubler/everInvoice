<?php

use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getIndexPermissions() as $indexPerm) {
            DB::table('roles_permissions')->insert([
                'role_id' => \App\Role::where('name', 'basic')->first()->id,
                'permission_id' => $indexPerm->id,
            ]);
        }

        foreach (\App\Permission::all() as $permission) {
            DB::table('roles_permissions')->insert([
                'role_id' => \App\Role::where('name', 'admin')->first()->id,
                'permission_id' => $permission->id,
            ]);
        }
    }

    protected function getIndexPermissions()
    {
        return \App\Permission::where('code', 'like', '%index')->get();
    }
}
