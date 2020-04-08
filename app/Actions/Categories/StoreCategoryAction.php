<?php


namespace App\Actions\Categories;

use App\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreCategoryAction extends Action
{
    public function storeModel(Model $category, Request $data): Model
    {
        $category->name = $data->input('name');
        $category->code = $data->input('code');
        $category->description = $data->input('description');
        $category->iva = $data->input('iva');

        $category->save();

        return $category;
    }
}
