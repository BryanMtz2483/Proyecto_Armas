<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Base;
use Illuminate\Http\Request;

class BasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retorna todas las bases militares existentes
        return response()->json(Base::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Valida que los campos de nombre y localización sean correctos y existan dentro de la petición
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        //Asigna esos campos al modelo "Base" y los guarda para crear un nuevo registro
        $base = Base::create($request->all());
        //En caso de que todo sea correcto se muestran los datos del registro creado y el código 201
        return response()->json($base,201);
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
    public function destroy(string $id)
    {
        //
    }
}
