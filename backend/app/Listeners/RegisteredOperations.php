<?php

namespace App\Listeners;

use App\Enums\RoleEnums;
use App\Events\UserRegistered;

class RegisteredOperations
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $userEvent): void
    {
        if ($userEvent->user->role_id->value == RoleEnums::MEMBER->value) {
            $userEvent->user->basket()->create();
        }
    }
}
