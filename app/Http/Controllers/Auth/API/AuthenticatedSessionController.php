<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\CreateTokenRequest;
use App\Http\Resources\AutheticatedUserResource;
use App\Models\User;
use App\Rules\ValidSystemToken;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use MagicLink\Actions\LoginAction;
use MagicLink\MagicLink;

class AuthenticatedSessionController extends Controller
{



    public function index(Request $request)
    {

        $user = $request->user();



        return new AutheticatedUserResource($user);
    }


    /**
     * Handle an incoming authentication request.
     *
     * @group Authentication
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    public function loginBySystem(Request $request)
    {
        $request->validate([
            'email' => ['required_without_all:phone_number,patasente_id', 'string', 'email', 'max:255'],
            'patasente_id' => ['required_without_all:email,phone_number','string', ],
            'phone_number' => ['required_without_all:email,patasente_id','string'], 
            'name' => [ 'string', 'max:255',  ],
            'system_id' => ['required', 'string', 'max:255',  ],
            'system_access_token' => ['required', 'string', 'max:255' , new ValidSystemToken() ],

        ]);
        
        $user = (new UserService())->firstOrCreate([
            'email' => $request->email,
            'patasente_id' => $request->patasente_id,
            'phone_number' => $request->phone_number,
            'name' => $request->name,
        ]);

        $action = new LoginAction(User::first());
        $action->response(redirect('/dashboard'));

        return response()->json([
            "message" => "Registered successfully",
            "user" => $user,
            "link" => MagicLink::create($action)->url
        ]);

    }


    /**
     * Generate Authorization token.
     *
     * @group Authentication
     */
    public function getToken(CreateTokenRequest $request): JsonResponse
    {
        $request->authenticate();
        $token = $request->user()->createToken($request->token_name);

        return response()->json(['token' => $token->plainTextToken]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @group Authentication
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
