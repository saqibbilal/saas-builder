<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Modules\Auth\Data\LoginData;
use App\Modules\Auth\Actions\LoginUserAction;

class LoginController extends Controller
{
    public function __invoke(
        LoginRequest $request,
        LoginUserAction $loginUserAction,
    ): JsonResponse {
        $data = LoginData::fromRequest(
            $request->validated()
        );

        $result = $loginUserAction($data);

        return response()->json([
            'message' => 'Login successful.',
            'data' => [
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ],
        ]);
    }
}
