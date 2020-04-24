<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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

        Gate::authorize('viewAny', Product::class);

        return response()->view('product.index', compact('products'));
    }
}
