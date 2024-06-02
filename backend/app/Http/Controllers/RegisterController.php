<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\RegisterService;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $storeUserRequest, RegisterService $registerService)
    {
        $registerService->register($storeUserRequest);

        return response()->json(
            [
                'data' => [
                    'message' => 'User successfully registered',
                ],
            ],
            Response::HTTP_CREATED
        );
    }
}
