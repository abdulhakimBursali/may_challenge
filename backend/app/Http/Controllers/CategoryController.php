<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $categoryService): JsonResource
    {
        $categories = $categoryService->index();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $storeCategoryRequest, CategoryService $categoryService): JsonResource
    {
        $category = $categoryService->store($storeCategoryRequest);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, int $id, CategoryService $categoryService): JsonResource|JsonResponse
    {
        $category = $categoryService->update($updateCategoryRequest, $id);

        if ($category) {
            return new CategoryResource($category);
        }

        return response()->json(['data' => ['message' => 'Category not found']], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, CategoryService $categoryService): JsonResponse
    {
        return $categoryService->delete($id);
    }

    /**
     * Display products in category.
     */
    public function products(string $id, CategoryService $categoryService): JsonResource
    {
        $products = $categoryService->products($id);

        return ProductResource::collection($products);
    }
}
