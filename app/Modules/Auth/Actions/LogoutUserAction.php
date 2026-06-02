<?php

namespace App\Modules\Auth\Actions;

use App\Models\User;
use App\Modules\Auth\Events\UserLoggedOut;

class LogoutUserAction
{
    public function __invoke(User $user): void
    {
        $user->currentAccessToken()?->delete();

        UserLoggedOut::dispatch($user);
    }
}
