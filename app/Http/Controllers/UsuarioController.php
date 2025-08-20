<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Roles;
use App\Models\Acciones;
use App\Models\Permisos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
    // Constructor para invocar el middleware
    public function __construct(){
        $this->middleware('verificar:ver_usuarios')->only('index');
        $this->middleware('verificar:crear_usuarios')->only('create', 'store');
        $this->middleware('verificar:editar_usuarios')->only('edit', 'update');
        $this->middleware('verificar:eliminar_usuarios')->only('destroy');
        $this->middleware('verificar:ver_detalle_usuarios')->only('show');
    }

    public function check(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))){
            return redirect()->intended('home');
        }
        return redirect('login')->with('type', 'danger')
                                    ->with('message', 'Correo o contraseña incorrecta');
    }
    //
    public function index()
    {
        $datos = Usuarios::all();
        return view('usuarios.index', compact('datos'));
    }

    public function create()
    {
        $roles = Roles::all();
        $acciones = Acciones::all();
        return view('usuarios.new', compact('roles', 'acciones'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'nombre' => 'required | max:50',
            'telefono' => 'required | max:20',
            'id_rol' => 'required',
            'email' => 'required | max:120',
            'password' => 'required | max:180',
            'accion_id[]' => 'required'
        ]);

        if ($validated->fails())
        {
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            $datos = $request->all(); // Datos -> Formulario
            $accion_id = $request->get('accion_id',[]); // Acciones -> Formulario
            $datos['password'] = Hash::make($datos['password']); // Encriptar contraseña
            $usuario = Usuarios::create($datos); // Variable -> Guarda Datos -> Inserta -> BD -> Arreglo

            // foreach ($accion_id as $id){
            //     $permiso = [
            //         'usuario_id' => $usuario->id,
            //         'accion_id' => $id
            //     ];
            //     Permisos::create($permiso);
            // }
            $permisos = [];
            foreach($accion_id as $accion){
                $permisos[] = $accion;
            }
            $permiso['accion_id'] = json_encode($permisos);
            $permiso['usuario_id'] = $usuario->id;
            Permisos::create($permiso);
            return redirect('usuarios')->with('type', 'success')
                                           ->with('message', 'Registro creado Correctamente');
        }
    }

    public function edit(string $id)
    {
        $datos = Usuarios::find($id);
        $roles = Roles::all();
        $permisos = Permisos::where('usuario_id', $id)->get('accion_id');
        foreach($permisos as $permiso){
            $permisosAsignados[] = $permiso['accion_id'];
        }
        $acciones = Acciones::all();
        return view('usuarios.edit', compact('datos', 'roles', 'permisosAsignados', 'acciones'));
    }

    public function update(Request $request, Usuarios $usuario)
    {
        $validated = Validator::make($request->all(),[
            'nombre' => 'required | max:50',
            'telefono' => 'required | max:20',
            'id_rol' => 'required',
            'email' => 'required | max:120',
            'password' => 'required | max:180',
            'accion_id[]' => 'required'
        ]);

        if ($validated->fails())
        {
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            $datos = $request->all();
            $datos['password'] = Hash::make($datos['password']);
            $usuario->update($datos);
            Permisos::where('usuario_id', $usuario->id)->delete();
            $acciones = $request->all('accion_id');
            // foreach($acciones['accion_id'] as $accion){
            //     $permiso['usuario_id'] = $usuario->id;
            //     $permiso['accion_id'] = $accion;
            //     Permisos::create($permiso);
            // }
            $permisos = [];
            foreach($acciones['accion_id'] as $accion){
                $permisos[] = $accion;
            }
            $permiso['accion_id'] = json_encode($permisos);
            $permiso['usuario_id'] = $usuario->id;
            Permisos::create($permiso);

            return redirect('usuarios')->with('type', 'info')
                                           ->with('message', 'Registro actualizado Correctamente');
        }   
    }

    public function destroy(string $id)
    {   
        Permisos::where('usuario_id', $id)->delete();
        Usuarios::destroy($id);
        return redirect('usuarios')->with('type', 'danger')
                                       ->with('message', 'Usuario eliminado correctamente');
    }

}
