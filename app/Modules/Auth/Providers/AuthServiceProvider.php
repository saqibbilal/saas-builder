<?php

namespace App\Modules\Auth\Providers;

use App\Modules\Auth\Events\UserLoggedIn;
use App\Modules\Auth\Events\UserLoggedOut;
use App\Modules\Auth\Events\UserRegistered;
use App\Modules\Auth\Listeners\LogAuthenticationActivityListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class AuthServiceProvider extends EventServiceProvider
{
    /**
     * The event to listener mappings.
     */
    protected $listen = [
        UserRegistered::class => [
            LogAuthenticationActivityListener::class,
        ],

        UserLoggedIn::class => [
            LogAuthenticationActivityListener::class,
        ],

        UserLoggedOut::class => [
            LogAuthenticationActivityListener::class,
        ],
    ];
}
