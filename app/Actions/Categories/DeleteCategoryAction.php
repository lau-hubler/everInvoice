<?php


namespace App\Actions\Categories;

use App\Category;

class DeleteCategoryAction
{
    public function execute(Category $category)
    {
        if ($category != Category::find(1)) {
            $category->delete();
            return __('This category was successfully deleted');
        }

        return __('This category is default and cannot be deleted!');
    }
}
