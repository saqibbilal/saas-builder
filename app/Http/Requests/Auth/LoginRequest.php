<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:255'],
        ];
    }

    public function throttleKey(): string
    {
        return strtolower((string) $this->string('email'))
            .'|'
            .$this->ip();
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts(
            $this->throttleKey(),
            5,
        )) {
            return;
        }

        $seconds = RateLimiter::availableIn(
            $this->throttleKey(),
        );

        throw ValidationException::withMessages([
            'email' => [
                "Too many login attempts. Try again in {$seconds} seconds.",
            ],
        ]);
    }

    public function hitRateLimiter(): void
    {
        RateLimiter::hit(
            $this->throttleKey(),
            60,
        );
    }

    public function clearRateLimiter(): void
    {
        RateLimiter::clear(
            $this->throttleKey(),
        );
    }
}
