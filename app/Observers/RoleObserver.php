<?php

namespace App\Observers;

use App\Role;
use Illuminate\Support\Facades\DB;

class RoleObserver
{

    /**
     * Handle the role "deleting" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function deleting(Role $role)
    {
        DB::table('roles_permissions')->where('role_id', $role->id)->delete();
    }
}
