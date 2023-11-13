<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\SelectUserResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = (new UserService())->store($request->all());
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    public function getOptionUsers(Request $request)
    {
        $search = $request->input('q'); // Assuming the search parameter is sent as a query parameter

        // Use the where clause to filter users based on the search parameter
        $users = User::where('name', 'like', "%$search%")->limit(10)->get();

        // Return the filtered users using the SelectUserResource
        return SelectUserResource::collection($users);
    }

    public function getOptionUser(Request $request)
    {
        return new SelectUserResource(User::find($request->input("id")));
    }


    public function createUser(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'email'=> ['required','string'],
        ]);

        $user = (new UserService())->store($request->all());

        return response()->json($user);
    }

}
