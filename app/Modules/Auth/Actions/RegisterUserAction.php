<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Contracts\AuthenticationServiceContract;
use App\Modules\Auth\Data\RegisterData;
use App\Modules\Auth\Events\UserRegistered;

class RegisterUserAction
{
    public function __construct(
        protected AuthenticationServiceContract $authenticationService,
    ) {}

    public function __invoke(RegisterData $data): array
    {
        $result = $this->authenticationService->register($data);

        UserRegistered::dispatch($result['user']);

        return $result;
    }
}
