<?php

namespace App\Modules\Auth\Contracts;

use App\Modules\Auth\Data\LoginData;
use App\Models\User;

interface AuthenticationServiceContract
{
    public function login(LoginData $data): array;
}
