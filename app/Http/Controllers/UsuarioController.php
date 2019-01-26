<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsuarioController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(UserRequest $request)
    {
        $usuario = new User($request->all());
        return ['resultado' => $usuario->save()];
    }

    public function update(User $usuario, Request $request)
    {

        return ['resultado' => $usuario->update($request->all())];
    }

    public function delete(User $usuario)
    {
        return ['resultado' => $usuario->delete()];
    }
    public function directores(){
        return User::where("tipo","director")->get();
    }
    public function profesores()
    {
        $profesores = User::where("tipo","profesor")->get();
        foreach ($profesores as $profesor) {
            $profesor->nombre_completo = $profesor->nombre . ' ' . $profesor->apellido;
        }
        return $profesores;
    }
}
