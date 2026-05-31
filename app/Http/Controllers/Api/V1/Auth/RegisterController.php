<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Modules\Auth\Actions\RegisterUserAction;
use App\Modules\Auth\Data\RegisterData;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(
        RegisterRequest $request,
        RegisterUserAction $registerUserAction,
    ): JsonResponse {
        $data = RegisterData::fromRequest(
            $request->validated()
        );

        $result = $registerUserAction($data);

        return response()->json([
            'user' => new UserResource($result['user']),
            'token' => $result['token'],
        ]);
    }
}
