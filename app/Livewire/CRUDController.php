<?php

namespace App\Livewire;

use App\Models\Base;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Credential;
use App\Models\Magazine;
use App\Models\MagazineType;
use App\Models\Military;
use App\Models\Rank;
use App\Models\Weapon;
use App\Models\WeaponLicense;
use App\Models\WeaponType;
use Livewire\WithPagination;

class CRUDController extends Component
{
    //Definimos variables que nos serán de utilidad para las funciones agregando además el soporte de paginación
    use WithPagination;
    public $modelName;
    public $operation;
    public $data = []; // contiene los datos del formulario.
    public $recordId;
    public $buscar = '';
    public $vista = false;
    public $ranks = [],$bases = [],$militaries = [], $magazines = [],$credentials = [], $weaponLicenses = [], $weapons = [], $weaponTypes = [],$magazineTypes = [],$weaponCodes = [],$magazineCodes = [];

    public function resetForm()
    {
        // Restablece todos los campos del formulario en cuestión 
        $this->data = array_fill_keys(array_keys($this->data), null);
        // Restablece la operación a 'create' (esto más que nada es por si estamos en el modo de actualización)
        $this->operation = 'create';
        // Restablece el ID del registro
        $this->recordId = null;
        // Oculta el formulario (esto más que nada es por si estamos en el modo de actualización)
        $this->vista = false;
    }
    //Función para que el formulario create siempre esté activo, esto se hace para evitar meter el formulario create en un modal
    public function verVista(){
        $this->vista = !$this->vista;
        if ($this->vista) {
            $this->operation = 'create';
            $this->resetForm();
            $this->vista = true; // Aseguramos que el formulario permanezca visible
        }
    }

    public function mount($modelName, $operation = 'create', $recordId = null)
    {
        //Configura el modelo ($modelName), la operación ($operation) y el ID del registro ($recordId).
        $this->modelName = ucfirst($modelName);
        $this->operation = $operation;
        $this->recordId = $recordId;
         //variable que manda a llamar el modelo (el modelo llamado dependerá de que modelo se está utilizando).
        $modelClass = 'App\\Models\\' . $this->modelName;

        if ($operation === 'update' && $recordId) {
            // Si estamos en modo actualización, cargamos los datos del registro
            $record = $modelClass::find($recordId);
            $this->data = $record ? $record->toArray() : [];
        } else {
            // Si estamos en modo creación, inicializamos $data con claves vacías para cada campo
            $this->data = array_fill_keys((new $modelClass)->getFillable(), null);
        }
        // Elimina los campos no editables (ID y fechas de creación y modificación)
    unset($this->data['id'], $this->data['created_at'], $this->data['updated_at']);

    // Obtener las opciones para los campos select
    if (in_array('rank_id', array_keys($this->data))) {
        $this->ranks = Rank::all(); // Trae todos los rangos
    }
    if (in_array('base_id', array_keys($this->data))) {
        $this->bases = Base::all(); // Trae todas las bases
    }
    if (in_array('military_id', array_keys($this->data))) {
        $this->militaries = Military::all(); // Trae todos los militares
    }
    if (in_array('magazine_id', array_keys($this->data))) {
        $this->magazines = Magazine::all(); // Trae todos los cargadores
    }
    if (in_array('credential_id', array_keys($this->data))) {
        $this->credentials = Credential::all(); // Trae todas las credenciales
    }
    if (in_array('weapon_id', array_keys($this->data))) {
        $this->weapons = Weapon::all(); // Trae todas las armas
    }
    if (in_array('weaponLicense_id', array_keys($this->data))) {
        $this->weaponLicenses = WeaponLicense::all(); // Trae todas las licencias de armas
    }
    if (in_array('weaponType_id', array_keys($this->data))) {
        $this->weaponTypes = WeaponType::all(); // Trae todos los tipos de armas
    }
    if (in_array('type_magazine', array_keys($this->data))) {
        $this->magazineTypes = MagazineType::all(); // Trae todos los tipos de cargadores
    }
    if (in_array('weapon_code', array_keys($this->data))) {
        $this->weaponCodes = Weapon::all(); // Trae todas las armas para poder usar su campo weapon_code
    }
    if (in_array('magazine_code', array_keys($this->data))) {
        $this->magazineCodes = Magazine::all(); // Trae todos las cargadores para poder usar su campo magazine_code
    }
    }

    public function save()
    {
        //variable que manda a llamar el modelo (el modelo llamado dependerá de que modelo se está utilizando).
        $modelClass = 'App\\Models\\' . $this->modelName;

        // Obtiene las reglas de validación y aplica a cada campo del formulario
        $rules = [];
        foreach ($modelClass::validationRules() as $field => $rule) {
            $rules["data.$field"] = $rule;
        }

        // Aplica la validación usando las reglas determinadas para los campos del formulario
        $this->validate($rules);

        // Realiza la creación o actualización del registro dependiendo el modo en el que estemos
        if ($this->operation === 'create') {
            $modelClass::create($this->data);
            $message = "Registro creado exitosamente.";
        } elseif ($this->operation === 'update') {
            $record = $modelClass::find($this->recordId);
            $record->update($this->data);
            $message = "Registro actualizado exitosamente.";
        }

        // Resetea el formulario y muestra el mensaje de operación exitosa
        session()->flash('message', $message);
        $this->resetForm();

        // Validar la compatibilidad entre arma y cargador. 
        if ($this->modelName === 'Weapon') { 
            $weaponType = WeaponType::find($this->data['weaponType_id']); 
                if ($weaponType && $weaponType->compatible_magazine_type !== $this->data['type_magazine']) { 
                    session()->flash('message', 'El tipo de cargador y el tipo de arma no son compatibles.'); return; 
                }
    }
}

    public function edit($id)
    {
         //variable que manda a llamar el modelo (el modelo llamado dependerá de que modelo se está utilizando).
        $modelClass = 'App\\Models\\' . $this->modelName;

        // Carga el registro seleccionado para edición
        $record = $modelClass::find($id);
        if ($record) {
            $this->data = $record->toArray();
            $this->recordId = $id;
            $this->operation = 'update';
            $this->vista = true; // Asegura que el formulario esté visible al estar en modo actualización
        } else {
            session()->flash('message', 'Registro no encontrado.');
        }
    }

    public function delete($id)
    {
        //variable que manda a llamar el modelo (el modelo llamado dependerá de que modelo que estemos utilizando) y lo elimina.
        $modelClass = 'App\\Models\\' . $this->modelName;
        $modelClass::destroy($id);

        session()->flash('message', 'Registro eliminado exitosamente.');
    }

    public function render()
    {
         //variable que manda a llamar el modelo (el modelo llamado dependerá de que modelo se está utilizando).
        $modelClass = 'App\\Models\\' . $this->modelName;

        //los registros pueden ser filtrados con el valor de buscar, se consulta el modelo para mostrar solo los registros que coincidan con los criterios ingresados por el usuario, en este caso solo funciona mediante el ID del registro.
        $records = $modelClass::where('id', 'like', '%' . $this->buscar . '%')->paginate(5);
        //Se retorna la vista de crud controller y se manda la variable records como parametro.
        return view('livewire.c-r-u-d-controller', ['records' => $records]);
        
    }
}