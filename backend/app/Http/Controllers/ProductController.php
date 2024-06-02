<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $storeProductRequest, ProductService $productService): JsonResource|JsonResponse
    {
        $product = $productService->store($storeProductRequest);

        if ($product) {
            return new ProductResource($product);
        }

        return response()->json(['data' => ['message' => 'Product not created']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $updateProductRequest, string $id, ProductService $productService): JsonResource|JsonResponse
    {
        $product = $productService->update($updateProductRequest, $id);

        if ($product) {
            return new ProductResource($product);
        }

        return response()->json(['data' => ['message' => 'Product not found']], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, ProductService $categoryService): JsonResponse
    {
        return $categoryService->delete($id);
    }
}
