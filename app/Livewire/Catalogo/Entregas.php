<?php

namespace App\Livewire\Catalogo;

use App\Models\Magazine;
use App\Models\Military;
use App\Models\Movement;
use App\Models\Weapon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Entregas extends Component
{
    public function render()
    {
        return view('livewire.catalogo.entregas');
    }
    public function createMovement()
{
    $this->validate();

    DB::transaction(function () {
        // Buscar al militar con sus licencias
        $military = Military::with('weaponLicenses')->findOrFail($this->military_id);
        // Buscar el arma con su código
        $weapon = Weapon::where('code', $this->weapon_code)->with('weaponTypes')->firstOrFail();

        // Validar si el militar tiene una licencia compatible con la categoría del arma
        $hasMatchingLicense = $military->weaponLicenses->contains(function ($license) use ($weapon) {
            return $license->name === $weapon->weaponTypes->category;
        });

        if (!$hasMatchingLicense) {
            throw new \Exception('El militar no tiene una licencia compatible con la categoría del tipo de arma.');
        }

        // Validar el cargador si se selecciona
        if ($this->magazine_code) {
            $magazine = Magazine::where('type_magazine', $weapon->type_magazine)
                ->where('code', $this->magazine_code)
                ->firstOrFail();
            
            if ($magazine->type_magazine !== $weapon->type_magazine) {
                throw new \Exception('El cargador debe coincidir con el tipo de arma seleccionado.');
            }
        }

        // Verificar el estado del arma
        if ($weapon->state !== 'aviable') {
            throw new \Exception('El arma seleccionada no está disponible.');
        }

        // Verificar el estado del cargador si se selecciona
        if ($this->magazine_code && $magazine->state !== 'aviable') {
            throw new \Exception('El cargador seleccionado no está disponible.');
        }

        // Crear el movimiento
        $movement = Movement::create([
            'military_id' => $this->military_id,
            'weapon_code' => $this->weapon_code,
            'magazine_code' => $this->magazine_code,
            'base_id' => $this->base_id,
            'date' => now(),
            'reason' => $this->reason,
        ]);

        // Actualizar el estado del arma a "entregada"
        $weapon->update(['state' => 'delivered']);
        
        // Actualizar el estado del cargador si se selecciona
        if ($this->magazine_code) {
            $magazine->update(['state' => 'delivered']);
        }

        session()->flash('success', 'Movimiento creado exitosamente.');
    });
}

}
