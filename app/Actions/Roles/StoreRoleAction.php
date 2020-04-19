<?php


namespace App\Actions\Roles;


use App\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreRoleAction extends Action
{

    public function storeModel(Model $role, Request $data): Model
    {
        $role->name = $data->input('name');
        $role->description = $data->input('description');
        $role->save();

        return $role;
    }
}
