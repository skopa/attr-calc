<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $reuest
     * @return UserResource
     */
    public function __invoke(Request $request): UserResource
    {
        return UserResource::make($request->user());
    }
}
