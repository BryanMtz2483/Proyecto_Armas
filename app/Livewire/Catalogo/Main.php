<?php

namespace App\Livewire\Catalogo;

use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;
    public $mView;
    public $dashModal;
    public function render()
    {
        return view('livewire.catalogo.main');
    }
    public function updated($property_name){
        if ($property_name === 'buscar') {
            $this-> resetPage();
        }
    }
}
