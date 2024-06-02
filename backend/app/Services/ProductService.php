<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProductService
{
    public function store(StoreProductRequest $storeCategoryRequest): ?Product
    {
        $imageService = new ImageService();
        $path = $imageService->uploadSingleImage($storeCategoryRequest);

        if ($path) {
            $product = new Product();
            $product->name = $storeCategoryRequest->name;
            $product->description = $storeCategoryRequest->description;
            $product->category_id = $storeCategoryRequest->category_id;
            $product->image_url = $path;
            $product->name = $storeCategoryRequest->name;
            $product->save();

            return $product;
        }

        return null;
    }

    public function update(UpdateProductRequest $updateProductRequest, string $id): ?Product
    {
        $product = Product::find($id);
        if ($product) {
            if ($updateProductRequest->image) {
                $imageService = new ImageService();
                $imageService->removeImage($product->image_url);
                $path = $imageService->uploadSingleImage($updateProductRequest);
                $product->image_url = $path;
            }

            $product->name = $updateProductRequest->name;
            $product->description = $updateProductRequest->description;
            $product->category_id = $updateProductRequest->category_id;
            $product->save();

            Log::info('Product Updated', [
                'data' => json_encode($product),
                'user_id' => $updateProductRequest->user()->id,
            ]);
        }

        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::find($id);

        if ($product) {
            $imageService = new ImageService();
            $imageService->removeImage($product->image_url);

            $product->delete();

            Log::info('Product Deleted', [
                'data' => json_encode($product),
                'user_id' => request()->user()->id,
            ]);

            return response()->json(['data' => ['message' => 'Product deleted']], Response::HTTP_OK);
        }

        return response()->json(['data' => ['message' => 'Product not found']], Response::HTTP_NOT_FOUND);
    }
}
