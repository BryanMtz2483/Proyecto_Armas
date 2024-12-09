<?php

namespace App\Livewire;

use App\Models\Movement;
use Livewire\Component;
use Livewire\WithPagination;

class CreateMovement extends Component
{
    //Definimos variables a necesitar y soporte para paginación
    use WithPagination;
    public $movementId, $military_id, $weapon_id, $magazine_id, $base_id, $date, $reason;
    public $isEdit = false;
    public $showForm = false;
    //definimos las reglas de validación de los campos
    protected $rules = [
        'military_id' => 'integer|required',
        'weapon_id' => 'integer|required',
        'magazine_id' => 'integer|required',
        'base_id' => 'integer|required',
        'date' => 'date|required',
        'reason' => 'required|string|max:255',
    ];
//Aplicamos las reglas de validación
    public function mount()
    {
        $this->rules = Movement::validationRules();
    }

    public function render()
    {
        //Renderizamos la vista y cargamos al modelo de movimientos junto con los modelos de military,weapon,magazine y de base, en el caso de armas y cargadores solo se mostrarán si su estado es disponible.
        return view('livewire.create-movement', [
            'movements' => Movement::with(['military', 'weapon', 'magazine', 'base'])->paginate(10),
            'militaries' => \App\Models\Military::all(),
            'weapons' => \App\Models\Weapon::where('state','aviable'),
            'magazines' => \App\Models\Magazine::where('state','aviable'),
            'bases' => \App\Models\Base::all(),
        ]);
    }

//función para actualizar el estatus de un arma y cargador dependiendo que botón se active(entregado, en entrega).
public function setStatus($movementId, $status)
{
    $movement = Movement::with(['weapon', 'magazine'])->findOrFail($movementId);

    if ($movement->weapon) {
        $movement->weapon->update(['state' => $status]);
    }

    if ($movement->magazine) {
        $movement->magazine->update(['state' => $status]);
    }

    session()->flash('success', "Estado cambiado a '{$status}' para arma y revista relacionadas.");
}
    //función para resetear los campos del modelo y dejar de mostrar el formulario
    public function resetForm()
    {
        $this->movementId = null;
        $this->military_id = null;
        $this->weapon_id = null;
        $this->magazine_id = null;
        $this->base_id = null;
        $this->date = null;
        $this->reason = null;
        $this->isEdit = false;
        $this->showForm = false;
    }
    //Función para mostrar el formulario create reseteado
    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }
    //Función que crea los movimientos, primero valida se las reglas de los campos, se asigna el valor de cada campo del formulario a cada campo del modelo y se da un mensaje de éxito.
    public function store()
    {
        $this->validate();

        Movement::create([
            'military_id' => $this->military_id,
            'weapon_id' => $this->weapon_id,
            'magazine_id' => $this->magazine_id,
            'base_id' => $this->base_id,
            'date' => $this->date,
            'reason' => $this->reason,
        ]);

        session()->flash('success', 'Movimiento creado exitosamente.');
        $this->resetForm();
    }
    //Función para actualizar un movimiento, primero encuentra el registro mediante su id, se obtienen los valores del registro seleccionado y se asignan a una variable y se muestra el formulario de edición
    public function edit($id)
    {
        $movement = Movement::findOrFail($id);

        $this->movementId = $movement->id;
        $this->military_id = $movement->military_id;
        $this->weapon_id = $movement->weapon_id;
        $this->magazine_id = $movement->magazine_id;
        $this->base_id = $movement->base_id;
        $this->date = $movement->date;
        $this->reason = $movement->reason;

        $this->isEdit = true;
        $this->showForm = true;
    }
    //Función para aplicar la actualización, primero se validan las reglas de los campos, luego se vuelve a obtener el registro con todos sus campos, se asigna el valor de cada campo del modelo a cada campo del modelo y se da un mensaje de éxito.
    public function update()
    {
        $this->validate();

        $movement = Movement::findOrFail($this->movementId);

        $movement->update([
            'military_id' => $this->military_id,
            'weapon_id' => $this->weapon_id,
            'magazine_id' => $this->magazine_id,
            'base_id' => $this->base_id,
            'date' => $this->date,
            'reason' => $this->reason,
        ]);

        session()->flash('success', 'Movimiento actualizado exitosamente.');
        $this->resetForm();
    }
    //Función para eliminar un registro  mediante su id, primero lo encuentra, lo elimina y da mensaje de confirmación
    public function delete($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->delete();

        session()->flash('success', 'Movimiento eliminado exitosamente.');
    }
}
