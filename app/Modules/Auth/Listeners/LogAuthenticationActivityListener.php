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
        $eventName = match (true) {
            $event instanceof UserRegistered => 'auth.register',
            $event instanceof UserLoggedIn => 'auth.login',
            $event instanceof UserLoggedOut => 'auth.logout',
        };

        activity()
            ->performedOn($event->user)
            ->causedBy($event->user)
            ->event($eventName)
            ->log($eventName);
    }
}
