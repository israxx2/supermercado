<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function singIn(Request $request)
    {
        $credentials = $request->only('rut', 'password');
        if (Auth::attempt($credentials, true)) return Auth::User();
        else return ["tipo" => "guest"];
    }

    public function singOut(Request $request)
    {
        return Auth::logout();
    }

    public function user(Request $request)
    {
        $user = Auth::User();
        if ($user) return $user;
        else return ["tipo" => "guest"];
    }

}
