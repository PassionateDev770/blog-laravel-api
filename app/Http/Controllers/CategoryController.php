<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }

    public function index():JsonResponse
    {
        $categories = Category::all();

        return $this->successResponse(CategoryResource::collection($categories));
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryRepository->create($request->validated());

        return $this->successResponse(new CategoryResource($category));
    }

    public function show(Category $category): JsonResponse
    {
        return $this->successResponse(new CategoryResource($category));
    }
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $categoryUpdated = $this->categoryRepository->update($request->validated(), $category);

        return $this->successResponse(new CategoryResource($categoryUpdated));
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->successResponse('Category deleted successfully');
    }
}
