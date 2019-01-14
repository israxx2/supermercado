<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        if (Auth::attempt($credentials, false)) return Auth::User();
        else return ["id_rol" => -1];
    }

    public function singOut(Request $request)
    {
        Auth::logout();
        Session::flush();
        return;
    }

    public function user(Request $request)
    {
        $user = Auth::User();
        if ($user) return $user;
        else return ["id_rol" => -1];
    }

}
