<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Contracts\AuthenticationServiceContract;
use App\Modules\Auth\Data\LoginData;
use App\Modules\Auth\Events\UserLoggedIn;

class LoginUserAction
{
    public function __construct(
        protected AuthenticationServiceContract $authenticationService,
    ) {}

    public function __invoke(LoginData $data): array
    {
        $result = $this->authenticationService->login($data);

        UserLoggedIn::dispatch(
            $result['user']
        );

        return $result;
    }
}
