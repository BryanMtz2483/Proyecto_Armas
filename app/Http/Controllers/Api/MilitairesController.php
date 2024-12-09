<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Military;
use Illuminate\Http\Request;

class MilitairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Military::all()); //Muestra todos los militares existentes en la base de datos
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
         // Valida que los datos de entrada en la solicitud sean correctos y existan dentro de la petición
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|required',
            'phone' => 'string|required', 
            'birth_date' => 'date|required', 
            'join_date' => 'date|required',
            'credential_id' => 'required|integer|exists:credentials,id',
            'weaponLicense_id' => 'required|integer|exists:weapon_licenses,id',
            'weapon_code' => 'required|string|max:255',
        ]);
        //Asigna esos campos al modelo "Military" y los guarda para crear un nuevo registro
        $military = Military::create($request->all());
        //En caso de que todo sea correcto se muestran los datos del registro creado y el código 201
        return response()->json($military, 201);

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
