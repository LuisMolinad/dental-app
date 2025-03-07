<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
//evento de enviar correo al mensaje creado
use Illuminate\Auth\Events\Registered;


use Svg\Tag\Circle;

class UsuarioController extends Controller
{

    function __construct()
    {

        $this->middleware(
            'permission:ver-Usuarios|editar-Usuarios|crear-Usuarios|borrar-Usuarios',
            ['only' => ['index']]
        );
        $this->middleware('permission:crear-Usuarios', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-Usuarios', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-Usuarios', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =  Role::pluck('name', 'name')->all();

        return view('usuarios.crear', compact('roles'));
        /*  return view('usuarios.crear'); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Valida los datos requeridos
        En el caso de la contrasena revisa que sea igual a la anterior
         */
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password|min:8',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // $admin =  $input['roles'];


        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        //enviar correo de verificacion al usuario creado
        /*   event(new Registered($user)); */
        // Almacena un mensaje en la sesión
        session()->flash('toastr', ['message' => 'Usuario creado exitosamente', 'type' => 'success']);
        return redirect()->route('usuarios.index');
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
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all(); //array que contiene el rol de usuario

        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        //Mensaje
        session()->flash('toastr', ['message' => 'Usuario editado exitosamente', 'type' => 'warning']);
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('toastr', ['message' => 'Usuario eliminado exitosamente', 'type' => 'error']);
        return redirect()->route('usuarios.index');
        //return redirect()->action([UsuarioController::class, 'index']);
    }
}
