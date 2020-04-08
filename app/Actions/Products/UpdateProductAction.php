<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateProductAction extends Action
{
    public function storeModel(Model $product, Request $data): Model
    {
        $product->update($data->validated());

        return Product::with('category')->find($product->id);
    }
}
