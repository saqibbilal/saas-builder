<?php

namespace App\Modules\Auth\Contracts;

use App\Modules\Auth\Data\LoginData;
use App\Modules\Auth\Data\RegisterData;

interface AuthenticationServiceContract
{
    public function login(LoginData $data): array;

    public function register(RegisterData $data): array;
}
