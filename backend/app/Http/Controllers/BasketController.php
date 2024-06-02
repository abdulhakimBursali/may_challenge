<?php

namespace App\Http\Controllers;

use App\Models\BasketUser;
use App\Models\BasketProduct;
use App\Services\BasketService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketController extends Controller
{
    public function index(BasketService $basketService): JsonResource
    {
        $user = Auth::user();

        return $basketService->productsResource($user->id);
    }

    public function addProduct(int $productId, BasketService $basketService)
    {
        $user = Auth::user();
        $basketUser = BasketUser::where('user_id', $user->id)->first();

        $basketUser->basketProducts()->firstOrCreate(
            ['product_id' => $productId],
            ['product_id' => $productId]

        );

        return $basketService->productsResource($user->id);
    }

    public function deleteProduct(int $productId, BasketService $basketService)
    {
        $user = Auth::user();

        BasketProduct::where('basket_id', $user->basket->id)
            ->where('product_id', $productId)
            ->delete();

        return $basketService->productsResource($user->id);
    }
}
