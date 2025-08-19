<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Permisos;
use App\Models\Acciones;
use Illuminate\Support\Facades\Validator;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Roles::all();
        return view('roles.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acciones = Acciones::all();
        return view('roles.new', compact('acciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nombre' => 'required | max:60'
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            $datos = $request->all(); // Datos recibidos del Front
            $accion_id = $request->get("accion", []); // Id's de las acciones recibidos del Front
            $registroRol = Roles::create($datos); // Variable que guarda los datos y los sube a la tabla Roles de la BD 

        // Ciclo que recorre las acciones dadas por el usuario     
        foreach ($accion_id as $id) {
            $permiso = [
                'rol_id' => $registroRol->id, // Id del rol recien creado
                'accion_id' => $id // Id de la acción
            ];
            Permisos::create($permiso); // Crear el registro en la tabla Permisos de la BD
        }
        // Redirijir hacia la pestaña index de roles
        return redirect('roles')->with('type', 'success')
                                ->with('message', 'Registro creado correctamente');
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
        // $datos = Roles::find($id);
        // return view('roles.edit', compact('datos'));

        $rol = Roles::findOrFail($id); // Capturar el id del rol a editar
        $permisos = Permisos::where('rol_id', $id)->get('accion_id');
        $permisosAsignados = []; // Inicializar la variable 
        foreach($permisos as $permiso) {
            $permisosAsignados[] = $permiso['accion_id'];
        }

        // Capturar las acciones en una variable
        $acciones = Acciones::all();
        // Retornar hacia la vista edit con las variables rol, permisosAsignados, acciones
        return view('roles.edit', compact('rol', 'permisosAsignados', 'acciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'nombre' => 'required | max:60'
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            // $datos = $request->all();
            // Roles::create($datos);

            $rol = Roles::findOrFail($id); // Crear variable que guarde el registro con la variable dado como argumento
            $rol->update($request->all()); // Actualizar los registro del rol
            Permisos::where('rol_id', $id)->delete(); // Eliminar el registro permisos que sea tenga el rol_id igual al id como argumento

            $acciones = $request->all('accion_id'); // Obtener las acciones 
            foreach($acciones['accion_id'] as $accion) {
                $permiso['rol_id'] = $id;
                $permiso['accion_id'] = $accion;
                Permisos::create($permiso);
            }
            return redirect('roles')->with('type', 'success')
                                    ->with('message', 'Registro actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        Permisos::where('rol_id', $id)->delete();
        Roles::destroy($id);
        return redirect('roles')->with('type', 'danger')
                                ->with('message', 'Rol eliminado correctamente');
    }
}
