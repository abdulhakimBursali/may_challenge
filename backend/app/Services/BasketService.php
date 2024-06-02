<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketService
{
    public function products(int $userId): Collection
    {
        return Product::whereHas('basketProduct', function (Builder $builder) use ($userId) {
            return $builder->whereHas('basketUser', function (Builder $query) use ($userId) {
                return $query->where('user_id', $userId);
            });
        })->get();
    }

    public function productsResource(int $userId): JsonResource
    {
        return ProductResource::collection($this->products($userId));
    }
}
