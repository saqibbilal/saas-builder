<?php

namespace App\Modules\Auth\Contracts;

use App\Modules\Auth\Data\LoginData;

interface AuthenticationServiceContract
{
    public function login(LoginData $data): array;
}
