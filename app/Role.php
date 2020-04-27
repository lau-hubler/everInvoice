<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use ColumnFillable;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id');
    }

    public function hasPermission($rule): bool
    {
        foreach ($this->permissions as $permission) {
            if ($permission->code == $rule) {
                return true;
            }
        }
        return false;
    }

    public function scopeAllPermissions()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return Permission::all();
        }

        return $user->role->permissions ;
    }
}
