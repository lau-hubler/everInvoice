<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|Collection|Response
     */
    public function index()
    {
        Gate::authorize('viewAny', Category::class);

        return response()->view('category.index');
    }
}
