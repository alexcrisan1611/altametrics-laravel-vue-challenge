<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Respect\Validation\Validator;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $emailIsValid = Validator::email()->validate(
            $request->post('email')
        );

        Gate::allowIf($emailIsValid);

        $authWasSuccessful = Auth::attempt([
            'email' => $request->post('email'),
            'password' => $request->post('password'),
        ]);

        Gate::allowIf($authWasSuccessful);

        return [
            'user' => Auth::user(),
            'token' => Auth::user()->createToken('default')->plainTextToken,
        ];
    }
}
