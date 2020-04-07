<?php


namespace App\Actions\Categories;


use App\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateCategoryAction extends Action
{

    public function storeModel(Model $category, Request $data): Model
    {
        $category->update($data->validated());

        return $category;
    }
}
