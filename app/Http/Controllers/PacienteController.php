<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{

    function __construct()
    {

        $this->middleware(
            'permission:ver-paciente|editar-paciente|crear-paciente|borrar-paciente',
            ['only' => ['index']]
        );
        $this->middleware('permission:crear-paciente', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-paciente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-paciente', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Almacenar el paciente creado
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario (puedes agregar validación aquí)

        $data = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string',
            'correo_electronico' => 'required|email|unique:pacientes,correo_electronico', // Regla de validación personalizada
            'nombre_contacto_emergencia' => 'nullable|string',
            'contacto_emergencia' => 'nullable|string',
        ], [
            'nombre.required' => 'El campo de nombre es obligatorio.',
            'apellido.required' => 'El campo de apellido es obligatorio.',
            'fecha_nacimiento.required' => 'El campo de fecha de nacimiento es obligatorio.',
            'telefono.required' => 'El campo de telefono es obligatorio.',
            'correo_electronico.required' => 'El campo de email es obligatorio.',
            'correo_electronico.unique' => 'Este correo electrónico ya está registrado.', // Mensaje de error personalizado
        ]);

        // Crear una nueva instancia del modelo Paciente
        $paciente = new Paciente($data);

        if ($paciente) {
            // return response()->json(['success' => 'Paciente creado exitosamente']);
            $paciente->save();

            // Flash el mensaje de éxito
            // session()->flash('toastr', ['message' => 'Paciente creado exitosamente', 'type' => 'success']);

            // Redirigir a la vista 'pacientes.index' con el mensaje
            // return redirect()->route('pacientes.index')->with('toastr', session('toastr'));
        } else {
            return response()->json(['errors' => ['general' => ['Error al crear el paciente']]], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $paciente = Paciente::find($id)->delete();
        var_dump($paciente);
        session()->flash('toastr', ['message' => 'Paciente eliminado exitosamente', 'type' => 'error']);
        return redirect()->route('pacientes.index');
    }
}
