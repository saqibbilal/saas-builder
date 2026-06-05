<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Modules\Auth\Actions\RegisterUserAction;
use App\Modules\Auth\Data\RegisterData;
use Illuminate\Http\JsonResponse;

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
