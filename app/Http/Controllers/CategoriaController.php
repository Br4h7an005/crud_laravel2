<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;


class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('verificar:ver_categorias')->only('index');
        $this->middleware('verificar:crear_categorias')->only('create', 'store');
        $this->middleware('verificar:editar_categorias')->only('edit', 'update');
        $this->middleware('verificar:eliminar_categorias')->only('destroy');
        $this->middleware('verificar:ver_detalle_categorias')->only('show');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Categoria::all();
        return view('categorias.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('categorias.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:200'
        ]);

        if ($validated->fails()){
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            Categoria::create($request->all());
            return redirect('categorias')->with('type', 'success')
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
        $datos = Categoria::find($id);
        return view('categorias.edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validated = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:200'
        ]);

        if ($validated->fails()){
            return back()->withErrors($validated)
                         ->withInput();
        } else {
            // Categoria::create($request->all());
            $categoria->update($request->all());
            return redirect('categorias')->with('type', 'info')
                                         ->with('message', 'Registro actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoria::destroy($id);
        return redirect('categorias')->with('type', 'danger')
                                     ->with('message', 'El registro se eliminó');
    }   
}
