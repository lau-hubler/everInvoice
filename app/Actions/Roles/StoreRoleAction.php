<?php


namespace App\Actions\Roles;

use App\Actions\Action;
use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreRoleAction extends Action
{
    public function storeModel(Model $role, Request $data): Model
    {
        $role->name = $data->input('name');
        $role->description = $data->input('description');
        $role->save();

        $selected = array_map(function ($permission) {
            return Permission::where('code', $permission)->first()->id;
        }, json_decode($data->input('selected')));

        $role->permissions()->attach($selected);

        return $role;
    }
}
