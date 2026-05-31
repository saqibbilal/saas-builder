<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\LogoutUserAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(
        Request $request,
        LogoutUserAction $logoutUserAction,
    ): JsonResponse {
        $logoutUserAction(
            $request->user()
        );

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
