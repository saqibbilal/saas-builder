<?php

namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Events\UserLoggedIn;
use App\Modules\Auth\Events\UserLoggedOut;
use App\Modules\Auth\Events\UserRegistered;

class LogAuthenticationActivityListener
{
    public function handle(
        UserRegistered|UserLoggedIn|UserLoggedOut $event,
    ): void {
        logger()->info(
            sprintf(
                '%s: User #%s (%s)',
                class_basename($event),
                $event->user->id,
                $event->user->email,
            )
        );
    }
}
