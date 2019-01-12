<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'resourceScript' => 'userIndex', 
            'resourceLink' => 'userIndex'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::All();

        return view('admin.users.create', [
            'resourceScript' => 'userCreate', 
            'resourceLink' => 'userCreate'
        ])
        ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            User::create($request->all())->save();
            session()->put('success','Se ha registrado la persona con correctamente.');    
        }
        catch(\Exception $e){
            session()->put('error','No se ha podido registrar a la persona. Intente denuevo o llame a soporte. Si el problema consiste contáctenos.');
        }
        
        return redirect()->route('admin.user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        return view('admin.users.edit', [
            'resourceScript' => 'userCreate', 
            'resourceLink' => 'userCreate'
        ])
        ->with('user', User::find($id))
        ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try{
            $user = User::find($id)->update($request->all());
            session()->put('success','Se modificado la persona con correctamente.');    
        }catch(\Exception $e){
            session()->put('error','No se ha podido modificar la persona. Si el problema continua contáctenos.');
        }

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->delete();
            session()->put('success','Se ha eliminado la persona correctamente.');
        } else 
        {
            session()->put('error','La persona no existe o ya se ha eliminado. Si el problema continua contáctenos.');  
        }

        return redirect()->route('admin.user.index');
    }

    public function changePassword(Request $request, $id)
    {

        $validation = $request->validate([
            'password' => 'sometimes|required|confirmed|min:6'
        ]);

        try{
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();
            session()->put('success','Se ha modificado la contraseña correctamente.');

        }catch(\Exception $e){
            session()->put('error','Error al modificar la contraseña. Si el problema continua contáctenos.');  
        }
        
        if(Auth::id() == $user->id) 
        {
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        } else 
        {
            return redirect()->route('admin.user.index');
        }

        
    }

}
