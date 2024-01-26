<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('MyAppToken')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        Log::debug($request);
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('MyAppToken')->accessToken;
            return response()->json(['token' => $token->token], 200);
        } else {
            return response()->json(['error' => 'Неправильные учетные данные'], 401);
        }
    }

    public function logout(): JsonResponse
    {
        // Ревокация (аннулирование) токена доступа текущего пользователя
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'Вы успешно вышли из системы']);
    }
}
