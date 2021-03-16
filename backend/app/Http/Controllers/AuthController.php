<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(405, $validator);
        }

        $token = Auth::guard()->attempt(['user' => $request->user, 'password' => $request->password]);

        if(!$token) {
            return $this->errorResponse(401, ['message' => 'Unauthorized.']);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::guard()->logout();
        return response(['message' => 'logged out']);
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $token = Auth::guard()->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(Auth::guard()->user());
    }

    /**
     * @return JsonResponse
     */
    public function getCurrentToken(): JsonResponse
    {
        $token = Auth::guard()->getToken()->get();
        return $this->respondWithToken($token);
    }
}
