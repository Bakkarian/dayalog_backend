<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    /**
     * Handle user registation
     *
     * @group Authentication
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required_without_all:phone_number,patasente_id', 'string', 'email', 'max:255', 'unique:'. User::class],
            // TODO : rename to patasente merchant code
            'patasente_id' => ['required_without_all:email,phone_number','string', 'unique:'. User::class ],
            'phone_number' => ['required_without_all:email,patasente_id','string', 'unique:'. User::class ],
            'password' => ['required'],
        ]);

        $user = (new UserService())->store($request->all());
        return response()->json([
            "message" => "Registered successfully",
            "user" => $user
        ]);
    }
}
