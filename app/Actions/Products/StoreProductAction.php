<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreProductAction extends Action
{
    public function storeModel(Model $product, Request $data): Model
    {
        $product->code = $data->input('code');
        $product->name = $data->input('name');
        $product->description = $data->input('description');
        $product->price = $data->input('price');
        $product->category_id = $data->input('category_id');

        $product->save();

        return Product::with('category')->find($product->id);
    }
}
