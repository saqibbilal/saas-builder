<?php

namespace App\Modules\Auth\Data;

readonly class LoginData
{
    public function __construct(
        public string $email,
        public string $password,
        public string $deviceName,
    ) {}

    public static function fromRequest(array $validatedData): self
    {
        return new self(
            email: $validatedData['email'],
            password: $validatedData['password'],
            deviceName: $validatedData['device_name'],
        );
    }
}
