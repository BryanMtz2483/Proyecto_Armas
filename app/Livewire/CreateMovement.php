<?php

namespace App\Livewire;

use App\Models\Movement;
use Livewire\Component;
use Livewire\WithPagination;

class CreateMovement extends Component
{
    use WithPagination;

    public $movementId, $military_id, $weapon_id, $magazine_id, $base_id, $date, $reason;
    public $isEdit = false;
    public $showForm = false;

    protected $rules = [
        'military_id' => 'integer|required',
        'weapon_id' => 'integer|required',
        'magazine_id' => 'integer|required',
        'base_id' => 'integer|required',
        'date' => 'date|required',
        'reason' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->rules = Movement::validationRules();
    }

    public function render()
    {
        return view('livewire.create-movement', [
            'movements' => Movement::with(['military', 'weapon', 'magazine', 'base'])->paginate(10),
            'militaries' => \App\Models\Military::all(),
            'weapons' => \App\Models\Weapon::all(),
            'magazines' => \App\Models\Magazine::all(),
            'bases' => \App\Models\Base::all(),
        ]);
    }


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

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

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

    public function delete($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->delete();

        session()->flash('success', 'Movimiento eliminado exitosamente.');
    }
}
