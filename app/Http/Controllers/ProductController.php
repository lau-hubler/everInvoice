<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response|Product[]
     */
    public function index()
    {
        $products = Product::with('category')->get();

        if (request()->wantsJson()) {
            return $products;
        }

        return response()->view('product', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Product::with('category')->find($product->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    }
}
