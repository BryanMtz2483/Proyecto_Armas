<?php

namespace App\Livewire\Catalogo;

use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    //Definición de variables y soporte para paginación
    use WithPagination;
    public $dashModal;
    public function render()
    {
        return view('livewire.catalogo.main');
    }
    //Función que reinicia las paginaciones al usar la función buscar. Cuando el usuario realiza una búsqueda, los resultados filtrados podrían tener menos páginas que los datos sin filtrar. Si no se reinicia la paginación, el usuario podría quedar en una página inválida o vacía al cambiar el criterio de búsqueda.
    public function updated($property_name){
        if ($property_name === 'buscar') {
            $this-> resetPage();
        }
    }
}
