<?php

namespace App\Modules\Auth\Actions;

use App\Models\User;

class LogoutUserAction
{
    public function __invoke(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }
}
