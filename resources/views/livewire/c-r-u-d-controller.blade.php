<div class="items-center lg:justify-center">
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Mensaje de Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <!-- Función de Búsqueda que funciona por ID -->
    <x-label>Search (Id search only allowed)</x-label>
    <x-input  style="width:300px;" class="float-start" type="text" placeholder="Search..." wire:model.live='buscar' > <br>
    </x-input> <br><br><br>

    <!-- Formulario CRUD -->
    <form wire:submit.prevent="save">
        <!-- Campos de entrada dinámica según el modelo (Dependiendo el modelo aparecerán sus respectivos campos para llenar el formulario)-->
        @foreach ($data as $field => $value)
        @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at') <!-- Condición para que no se permita actualizar los campos de ID y fecha de creación y de modificación -->
            <div class="form-group">
                <x-label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</x-label><!-- Etiqueta que va cambiando y apareciendo por cada campo de cierto modelo -->

                <!-- Selección de tipo de campo según el nombre y tipo del campo, todo esto se hizo ya que al querer actualizar ciertos campos el tipo de input se cambiaba, por ejemplo inputs de select al momento de querer actualizar se convertían en inputs normales, solo se mete dentro de la condición los campos especiales como dates y selects (dependiendo de los modelos y los campos a solicitar se programan en esta condicion, esto ya depende completamente del programador), en caso de que el campo no sea uno de ellos se queda cono un input normal de tipo texto-->
                @if($field === 'description')
                    <textarea wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"></textarea>
                @elseif($field === 'reason')
                    <textarea wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"></textarea>
                @elseif($field === 'birth_date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'join_date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'emision')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'expiration')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">

                @elseif($field === 'rank_id') <!-- Si el campo es un ID de la tabla 'ranks', se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea)-->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"> <!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Range</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">
                            {{ $rank->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'base_id') <!-- Si el campo es un ID de la tabla 'bases' se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea-->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Base</option>
                    @foreach ($bases as $base)
                        <option value="{{ $base->id }}">
                            {{ $base->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'credential_id') <!-- Si el campo es un ID de la tabla 'Credenciales', se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea-->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Credential</option>
                    @foreach ($credentials as $credential)
                        <option value="{{ $credential->id }}">
                            {{ $credential->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'magazine_id') <!-- Si el campo es un ID de la tabla 'Magazines, se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Magazine</option>
                    @foreach ($magazines as $magazine)
                        <option value="{{ $magazine->id }}">
                            {{ $magazine->model_magazine }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weapon_id') <!-- Si el campo es un ID de la tabla 'Weapons',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Selectr a Weapon</option>
                    @foreach ($weapons as $weapon)
                        <option value="{{ $weapon->id }}">
                            {{ $weapon->model }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weaponLicense_id') <!-- Si el campo es un ID de la tabla 'WeaponsLicenses',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Weapon License</option>
                    @foreach ($weaponLicenses as $weaponLicense)
                        <option value="{{ $weaponLicense->id }}">
                            {{ $weaponLicense->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weaponType_id') <!-- Si el campo es un ID de la tabla 'WeaponTypes',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Weapon Type</option>
                    @foreach ($weaponTypes as $weaponType)
                        <option value="{{ $weaponType->id }}">
                            {{ $weaponType->category }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'military_id') <!-- Si el campo es un ID de la tabla 'militaries',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Military</option>
                    @foreach ($militaries as $military)
                        <option value="{{ $military->id }}">
                            {{ $military->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'state')
                <select wire:model="data.{{ $field }}" class="form-control" ><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Option</option>
                    <option value="aviable">Disponible</option>
                    <option value="unaviable">No Disponible</option>
                </select>
                @elseif($field === 'type_magazine') <!-- Si el campo es un ID de la tabla 'Magazine Type',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Magazine Type</option>
                    @foreach ($magazineTypes as $magazineType)
                        <option value="{{ $magazineType->name }}">
                            {{ $magazineType->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weapon_code') <!-- Si el campo es un ID de la tabla 'Werapons',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a Weapon by code</option>
                    @foreach ($weaponCodes as $weaponCode)
                        <option value="{{ $weaponCode->code }}">
                            {{ $weaponCode->code }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'magazine_code') <!-- Si el campo es un ID de la tabla 'Magazines',se hace un select con un for each para mostrar los datos existentes de otros modelos (ya que es llave foránea -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"> <!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                    <option value="">Select a magazine by Code</option>
                    @foreach ($magazineCodes as $magazineCode)
                        <option value="{{ $magazineCode->code }}" >
                            {{ $magazineCode->code }}
                        </option>
                    @endforeach
                </select>
                @else
                    <input type="text" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"><!--wire model defer acumula cambios que se realicen en el modelo pero espera a "algo" que aplique dicho cambio, en este caso es el botón de crear -->
                @endif
            </div>
        @endif
        @endforeach            
        <!-- Botones para las operaciones CRUD (estos cambian dependiento si estamos en el formulario de creación o actualización, si estamos en creación el botón tendrá el texto crear y si estamos en modo actualizar el boton cambia y tendrá el texto actualizar y se mostrará otro botón de cancelación para volver al modo de creación) -->
        <br><button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" type="submit" class="btn btn-primary">
            @if ($operation === 'create')
                Create
            @elseif ($operation === 'update')
                Update
            @endif
        </button><br>

        @if ($operation === 'update')
            <x-danger-button type="button" class="btn btn-secondary" wire:click="resetForm">Cancel</x-danger-button>
        @endif
    </form>

    <!-- Tabla de Registros, Aquí mostramos la tabla con todos los registros, se muestra de manera distinta según sea el modelo -->
    <br>
    <table  class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr>
                <!-- Encabezados dinámicos según los campos en $data, dependiendo los campos existentes en el modelo se irán imprimiendo en el header de la tabla-->
                @foreach (array_keys($data) as $field)
                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Listado de registros -->
            @foreach ($records as $record)
                <tr>
                    <!-- Mostrar valores dinámicos de los registros según los campos en $data, dependiendo los campos existentes en el modelo se irán imprimiendo en el cuerpo de la tabla-->
                    @foreach ($data as $field => $value)
                        <td>{{ $record->$field }}</td>
                    @endforeach
                    <td>
                        <!-- Botón para editar, al presionarse se manda el id del registro seleccionado a su respectiva función para activar el modo de actualización-->
                        <button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" wire:click="edit({{ $record->id }})">Editar</button>
                        <!-- Botón para eliminar, al presionarse se manda el id del registro seleccionado a su respectiva función para borrar el registro al cual pertenece ese botón -->
                        <x-danger-button class="btn btn-sm btn-danger" wire:click="delete({{ $record->id }})">Delete</x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

