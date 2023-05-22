<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
            'patasente_id' => ['required_without_all:email,phone_number','string', 'unique:'. User::class ],
            'phone_number' => ['required_without_all:email,patasente_id','string', 'unique:'. User::class ],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return response()->json([
            "message" => "Registered successfully"
        ]);
    }
}
