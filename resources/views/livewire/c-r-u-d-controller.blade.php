<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Erroress de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-label>Buscador (Solo se permite búsqueda por ID)</x-label>
    <x-input  style="width:300px;" class="float-start" type="text" placeholder="Buscar..." wire:model.live='buscar' > <br>
    </x-input> <br><br><br>
    <!-- Formulario CRUD -->
    <form wire:submit.prevent="save">
        <!-- Campos de entrada dinámica según el modelo -->
        @foreach ($data as $field => $value)
        @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at')
            <div class="form-group">
                <x-label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</x-label>

                <!-- Selección de tipo de campo según el nombre y tipo del campo -->
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
                @elseif($field === 'rank_id') <!-- Si el campo es un ID de la tabla 'ranks' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un Rango</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">
                            {{ $rank->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'base_id') <!-- Si el campo es un ID de la tabla 'bases' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona una Base</option>
                    @foreach ($bases as $base)
                        <option value="{{ $base->id }}">
                            {{ $base->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'credential_id') <!-- Si el campo es un ID de la tabla 'Credenciales' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona una Credencial</option>
                    @foreach ($credentials as $credential)
                        <option value="{{ $credential->id }}" @if($credential->id == $value) selected @endif>
                            {{ $credential->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'magazine_id') <!-- Si el campo es un ID de la tabla 'Magazines' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un Cargador</option>
                    @foreach ($magazines as $magazine)
                        <option value="{{ $magazine->id }}" @if($magazine->id == $value) selected @endif>
                            {{ $magazine->model_magazine }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weapon_id') <!-- Si el campo es un ID de la tabla 'Weapons' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un Arma</option>
                    @foreach ($weapons as $weapon)
                        <option value="{{ $weapon->id }}" @if($weapon->id == $value) selected @endif>
                            {{ $weapon->model }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weaponLicense_id') <!-- Si el campo es un ID de la tabla 'WeaponsLicenses' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona una Licencia para armas</option>
                    @foreach ($weaponLicenses as $weaponLicense)
                        <option value="{{ $weaponLicense->id }}" @if($weaponLicense->id == $value) selected @endif>
                            {{ $weaponLicense->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'weaponType_id') <!-- Si el campo es un ID de la tabla 'WeaponTypes' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un tipo de arma</option>
                    @foreach ($weaponTypes as $weaponType)
                        <option value="{{ $weaponType->id }}" @if($weaponType->id == $value) selected @endif>
                            {{ $weaponType->category }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'military_id') <!-- Si el campo es un ID de la tabla 'militaries' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un militar</option>
                    @foreach ($militaries as $military)
                        <option value="{{ $military->id }}" @if($military->id == $value) selected @endif>
                            {{ $military->name }}
                        </option>
                    @endforeach
                </select>
                @elseif($field === 'state')
                <select wire:model="data.{{ $field }}" class="form-control" >
                    <option value="">Selecciona una Opción</option>
                    <option value="aviable">Disponible</option>
                    <option value="unaviable">No Disponible</option>
                </select>
                @elseif($field === 'model_magazine') <!-- Si el campo es un ID de la tabla 'Magazines' -->
                <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                    <option value="">Selecciona un Modelo de cargador</option>
                    @foreach ($weapons as $weapon)
                        <option value="{{ $weapon->model }}" @if($weapon->id == $value) selected @endif>
                            {{ $weapon->model }}
                        </option>
                    @endforeach
                </select>
                <x-input  style="margin: 10px; width:300px;" class="float-end" type="text" placeholder="Buscar..." wire:model.live='buscar' > <br>
                </x-input>
                @else
                    <input type="text" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @endif
            </div>
        @endif
        @endforeach            
        <!-- Botones para las operaciones CRUD -->
        <br><button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" type="submit" class="btn btn-primary">
            @if ($operation === 'create')
                Crear
            @elseif ($operation === 'update')
                Actualizar
            @endif
        </button><br>

        @if ($operation === 'update')
            <x-danger-button type="button" class="btn btn-secondary" wire:click="resetForm">Cancelar</x-danger-button>
        @endif
    </form>

    <!-- Tabla de Registros -->
    <br>
    <table  class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr>
                <!-- Encabezados dinámicos según los campos en $data -->
                @foreach (array_keys($data) as $field)
                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                @endforeach
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Listado de registros -->
            @foreach ($records as $record)
                <tr>
                    <!-- Mostrar valores dinámicos según los campos en $data -->
                    @foreach ($data as $field => $value)
                        <td>{{ $record->$field }}</td>
                    @endforeach
                    <td>
                        <!-- Botón para editar -->
                        <button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" wire:click="edit({{ $record->id }})">Editar</button>
                        <!-- Botón para eliminar -->
                        <x-danger-button class="btn btn-sm btn-danger" wire:click="delete({{ $record->id }})">Eliminar</x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
