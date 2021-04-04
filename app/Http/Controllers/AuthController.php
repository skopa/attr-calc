<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return UserResource
     */
    public function login(Request $request): UserResource
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');
        $gUser = $driver->userFromToken($request->get('token'));

        /** @var User $user */
        $user = User::query()->updateOrCreate(
            ['email' => $gUser->getEmail()],
            ['name' => $gUser->getName(), 'password' => Str::uuid()]
        );

        Auth::login($user);

        return UserResource::make($user);
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json();
    }
}
