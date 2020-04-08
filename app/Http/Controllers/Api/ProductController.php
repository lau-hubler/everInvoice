<?php

namespace App\Http\Controllers\Api;

use App\Actions\Products\StoreProductAction;
use App\Actions\Products\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        return Product::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @param StoreProductAction $action
     * @return Model|Response
     */
    public function store(ProductRequest $request, Product $product, StoreProductAction $action)
    {
        return $action->execute($product, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(Product $product)
    {
        return Product::with('category')->find($product->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @param UpdateProductAction $action
     * @return Model
     */
    public function update(ProductRequest $request, Product $product, UpdateProductAction $action): Model
    {
        return $action->execute($product, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return array|Response|string
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return __('This product was successfully deleted');
    }
}
