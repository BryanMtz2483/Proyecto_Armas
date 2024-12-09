<?php

namespace App\Livewire\Catalogo;

use App\Models\Movement;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class AdminEntrega extends Component
{
    public $movements =[];
    public $response='';
    public function mount(){
        $this->adminMovements();
    }
    
    public function adminMovements(){
        $this->movements = Movement::with(['weapon','magazine'])->where('date','<', Carbon::now()->subMinutes(1))->get();

        foreach($this->movements as $movement){
            $movement->delivered = $movement->weapon->state === 'Delivered' &&
            $movement->delivered = $movement->magazine->state === 'Delivered';
        }
    }
    public function stateDelivered($movementID){

        $movement = Movement::find($movementID);
        if ($movement){
        $magazine = $movement->magazine;
        $magazine->state = 'delivered';         
        $magazine->save();

        $weapon = $movement->weapon;
        $weapon->state = 'delivered';
        $weapon->save();

        $this->response = 'The states of the weapon and magazine changed succesfully';

        $this->adminMovements();
        }else{
            $this->response = 'Movimiento no encontrado :(';
        }
    }
    public function render()
    {
        return view('livewire.catalogo.admin-entrega', ["registers" => Movement::all()]);
    }

}
