<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $categories = Category::all();

        return response()->json(['categories' => CategoryResource::collection($categories)]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['position'] = Category::max('position') + 1;
        $category = Category::create($data);

        return response()->json(['category' => new CategoryResource($category)], Response::HTTP_CREATED);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json(['category' => new CategoryResource($category)]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
