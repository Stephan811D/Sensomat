<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
            //$accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'login' => ['Fehler: Die Anmeldeinformationen sind falsch.']
        ]);
    }
    public function logout()
    {
        Auth::logout();
    }
}
