<?php

namespace App\Services;

use App\Enums\RoleEnums;
use App\Events\UserRegistered;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegisterService
{
    public function register(StoreUserRequest $storeUserRequest): void
    {
        $user = new User();
        $user->role_id = RoleEnums::MEMBER;
        $user->name = $storeUserRequest->name;
        $user->surname = $storeUserRequest->surname;
        $user->password = $storeUserRequest->password;
        $user->email = $storeUserRequest->email;
        $user->phone = $storeUserRequest->phone;
        $user->save();

        UserRegistered::dispatch($user);
    }
}
