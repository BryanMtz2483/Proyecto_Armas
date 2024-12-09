<?php

namespace App\Livewire\Catalogo;

use App\Models\Movement;
use App\Models\Military;
use Livewire\Component;
use Carbon\Carbon;

class AdminEntrega extends Component
{
    // Definimos las variables que necesitaremos
    public $movements = [];
    public $response = '';

    public function mount()
    {
        $this->adminMovements();
    }
    
    public function adminMovements()
    {
        // Obtenemos los movimientos con armas y cargadores asociados cuyo movimiento sea anterior a 1 minuto
        $this->movements = Movement::with(['weapon', 'magazine'])
            ->where('date', '<', Carbon::now()->subMinutes(1))
            ->get();

        foreach ($this->movements as $movement) {
            // Verificamos si tanto el arma como el cargador están entregados
            $weaponDelivered = $movement->weapon && $movement->weapon->state === 'delivered';
            $magazineDelivered = $movement->magazine && $movement->magazine->state === 'delivered';

            $movement->delivered = $weaponDelivered && $magazineDelivered;
        }
    }

    public function stateDelivered($movementID)
    {
        // Buscar el movimiento con sus relaciones
        $movement = Movement::with(['weapon', 'magazine'])->find($movementID);
    
        if ($movement) {
            // Verificar si el arma existe
            if ($movement->weapon && $movement->magazine) {
                // Cambiar el estado del arma y cargador a 'entregado'
                $movement->weapon->state = 'entregado';  // Actualizamos el estado del arma
                $movement->weapon->save(); // Guardamos los cambios del arma
    
                $movement->magazine->state = 'entregado';  // Actualizamos el estado del cargador
                $movement->magazine->save(); // Guardamos los cambios del cargador
    
                // También podemos actualizar el estado del movimiento si es necesario
                $movement->state = 'entregado'; 
                $movement->save(); // Guardamos el estado del movimiento
    
                // Respuesta de éxito
                $this->response = 'El estado del arma y el cargador se han cambiado a entregado exitosamente';
    
                // Actualizamos los movimientos en la vista
                $this->adminMovements();
            } else {
                // Si no hay arma o cargador asociados
                $this->response = 'El movimiento no tiene un arma o un cargador válido';
            }
        } else {
            // Si no se encuentra el movimiento
            $this->response = 'Movimiento no encontrado :(';
        }
    }
    public function render()
    {
        // Renderizamos la vista con todos los movimientos
        return view('livewire.catalogo.admin-entrega', ["registers" => $this->movements]);
    }
}
