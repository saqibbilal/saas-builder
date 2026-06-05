<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Modules\Auth\Actions\LoginUserAction;
use App\Modules\Auth\Data\LoginData;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(
        LoginRequest $request,
        LoginUserAction $loginUserAction,
    ): JsonResponse {
        $request->ensureIsNotRateLimited();

        $data = LoginData::fromRequest(
            $request->validated(),
        );

        try {
            $result = $loginUserAction($data);

            $request->clearRateLimiter();
        } catch (ValidationException $exception) {
            $request->hitRateLimiter();

            throw $exception;
        }

        return response()->json([
            'message' => 'Login successful.',
            'data' => [
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ],
        ]);
    }
}
