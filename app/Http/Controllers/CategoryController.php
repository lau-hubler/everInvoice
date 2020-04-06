<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|Collection|Response
     */
    public function index()
    {
        $categories = Category::all();

        if (request()->wantsJson()) {
            return $categories;
        }

        return response()->view('models.category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return array|Response
     */
    public function store(CategoryRequest $request)
    {
        return Category::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @return Category|Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return Category|Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     */
    public function destroy(Category $category)
    {
        if ($category != Category::find(1)) {
            Category::find($category->id)->delete();
        }
    }
}
