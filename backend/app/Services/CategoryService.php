<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CategoryService
{
    public function index()
    {
        return Category::all();
    }

    public function store(StoreCategoryRequest $storeCategoryRequest): Category
    {
        $categoryData = $storeCategoryRequest->toArray();
        $category = Category::create($categoryData);

        /** Graylog benzeri bir yapı ile log kaydı tutulabilir. */
        Log::info('Category Created', [
            'data' => json_encode($categoryData),
            'user_id' => $storeCategoryRequest->user()->id,
        ]);

        return $category;
    }

    public function update(UpdateCategoryRequest $updateCategoryRequest, string $id): ?Category
    {
        $Category = Category::find($id);

        if ($Category) {
            $Category->name = $updateCategoryRequest->name;
            $Category->save();

            Log::info('Category Updated', [
                'data' => json_encode($Category),
                'user_id' => $updateCategoryRequest->user()->id,
            ]);
        }

        return $Category;
    }

    public function delete(int $id): JsonResponse
    {
        $category = Category::find($id);

        if ($category) {
            if (Product::where('category_id', $id)->count() != 0) {
                return response()->json(['data' => ['message' => 'Using category ID']], Response::HTTP_CONFLICT);
            }

            $category->delete();

            Log::info('Category Deleted', [
                'data' => json_encode($category),
                'user_id' => request()->user()->id,
            ]);

            return response()->json(['data' => ['message' => 'Category deleted']], Response::HTTP_OK);
        }

        return response()->json(['data' => ['message' => 'Category not found']], Response::HTTP_NOT_FOUND);
    }

    public function products(int $id): Collection
    {
        $products = Product::where('category_id', $id)->get();

        return $products;
    }
}
