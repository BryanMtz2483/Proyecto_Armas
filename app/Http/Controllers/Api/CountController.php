<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Base;
use App\Models\Credential;
use App\Models\Magazine;
use App\Models\MagazineType;
use App\Models\Military;
use App\Models\Movement;
use App\Models\Rank;
use App\Models\Weapon;
use App\Models\WeaponLicense;
use App\Models\WeaponType;
use Illuminate\Http\Request;

class CountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se muestran todos los modelos existentes y la cantidad de registros mediante un array en el cual se pone una información referenciando a uhn modelo y se cuentan los registros de los modelos mediante la función count.
        $models = [
            'Cantidad de Bases Existentes' => Base::count(),
            'Cantidad de Rangos Existentes' => Rank::count(),
            'Cantidad de Credenciales Existentes' => Credential::count(),
            'Cantidad de tipos de armas Existentes' => WeaponType::count(),
            'Cantidad de tipos de cargadores Existentes' => MagazineType::count(),
            'Cantidad de Armas Existentes' => Weapon::count(),
            'Cantidad de Licencias de armas Existentes' => WeaponLicense::count(),
            'Cantidad de Militares Existentes' => Military::count(),
            'Cantidad de Cargadores Existentes' => Magazine::count(),
            'Cantidad de Movimientos Registrados' => Movement::count(),
        ];
        //Se muestra un JSON con toda la información del arreglo
        return response()->json([
            'message' => 'Cantidad de Registros por Modelos',
            'data' => $models 
        ], 200); 

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
        //
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
