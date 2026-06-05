<?php

namespace App\Modules\Auth\Services;

use App\Models\User;
use App\Modules\Auth\Contracts\AuthenticationServiceContract;
use App\Modules\Auth\Data\LoginData;
use App\Modules\Auth\Data\RegisterData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationService implements AuthenticationServiceContract
{
    public function login(LoginData $data): array
    {
        $user = User::query()
            ->where('email', $data->email)
            ->first();

        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials provided.'],
            ]);
        }

        $token = $user->createToken($data->deviceName)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function register(RegisterData $data): array
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        $token = $user->createToken($data->deviceName)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
