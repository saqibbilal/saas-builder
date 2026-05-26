<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Contracts\AuthenticationServiceContract;
use App\Modules\Auth\Data\LoginData;

class LoginUserAction
{
    public function __construct(
        protected AuthenticationServiceContract $authenticationService,
    ) {}

    public function __invoke(LoginData $data): array
    {
        return $this->authenticationService->login($data);
    }
}
