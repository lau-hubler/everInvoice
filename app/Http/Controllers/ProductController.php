<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
     * @return Collection|Response|Product[]
     */
    public function index()
    {
        $products = Product::with('category')->get();

        if (request()->wantsJson()) {
            return $products;
        }

        return response()->view('models.product', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return Product::with('category')->find($product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Builder|Response
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
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return Product::with('category')->find($product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
