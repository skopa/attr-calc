<?php

namespace App\Http\Controllers;

use App\Models\User;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');
        $gUser = $driver->userFromToken($request->get('token'));

        /** @var User $user */
        $user = User::query()
            ->firstOrCreate([
                'email' => $gUser->getEmail()
            ], [
                'email' => $gUser->getEmail(),
                'name' => $gUser->getName(),
                'password' => Str::uuid()
            ]);

        Auth::login($user);

        return response()->json($user);
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json();
    }
}
