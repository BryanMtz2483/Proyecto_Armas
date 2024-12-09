<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Gestión de Movimientos</h1>
<!-- Mensaje de éxito -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!--Si la variable showform es true se muestra un formulario para crear un movimiento, en el proceso de enviar el formulario se valida si el mismo es para crear o actualizar con la variable isEdit, en caso de que sea positiva se aplicarán los cambios de actualización, en caso de que no se aplicaran cambios para creación de registros. Se contienen selects que están vinculados a datos de otras tablas y mediante un foreach se van mostrando las posibles respuestas que son los registros existentes de otras tabas -->
    @if ($showForm)
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="military_id" class="block text-gray-700 text-sm font-bold mb-2">Militar:</label>
                <select wire:model="military_id" id="military_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('military_id') border-red-500 @enderror">
                    <option value="">Seleccione un militar</option>
                    @foreach ($militaries as $military)
                        <option value="{{ $military->id }}">{{ $military->name }}</option>
                    @endforeach
                </select>
                @error('military_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="weapon_id" class="block text-gray-700 text-sm font-bold mb-2">Arma:</label>
                <select wire:model="weapon_id" id="weapon_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('weapon_id') border-red-500 @enderror">
                    <option value="">Seleccione un arma</option>
                    @foreach ($weapons as $weapon)
                        <option value="{{ $weapon->id }}">{{ $weapon->model }}</option>
                    @endforeach
                </select>
                @error('weapon_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="magazine_id" class="block text-gray-700 text-sm font-bold mb-2">Revista:</label>
                <select wire:model="magazine_id" id="magazine_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('magazine_id') border-red-500 @enderror">
                    <option value="">Seleccione una revista</option>
                    @foreach ($magazines as $magazine)
                        <option value="{{ $magazine->id }}">{{ $magazine->code }}</option>
                    @endforeach
                </select>
                @error('magazine_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="base_id" class="block text-gray-700 text-sm font-bold mb-2">Base:</label>
                <select wire:model="base_id" id="base_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('base_id') border-red-500 @enderror">
                    <option value="">Seleccione una base</option>
                    @foreach ($bases as $base)
                        <option value="{{ $base->id }}">{{ $base->name }}</option>
                    @endforeach
                </select>
                @error('base_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Fecha:</label>
                <input wire:model="date" type="date" id="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('date') border-red-500 @enderror">
                @error('date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Razón:</label>
                <textarea wire:model="reason" id="reason"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('reason') border-red-500 @enderror"></textarea>
                @error('reason')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ $isEdit ? 'Actualizar' : 'Crear' }}
                </button>
                <button type="button" wire:click="resetForm" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancelar
                </button>
            </div>
        </form>
    @else
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-4">
            Crear Movimiento
        </button>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Militar</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Arma</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Revista</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Base</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Creacion</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Razón</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200"> <!--Se muestran todos los registros de la tabla de movimientos-->
                @foreach ($movements as $movement)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->id }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->military->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->weapon->model ?? 'N/A' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->magazine->code ?? 'N/A' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->base->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $movement->date }}</td>
                        <td class="px-4 py-2">{{ $movement->reason }}</td>
                        <td class="px-4 py-2 whitespace-nowrap space-x-2">
                            <button wire:click="edit({{ $movement->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">
                                Editar
                            </button>
                            <button wire:click="delete({{ $movement->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">
                                Eliminar
                            </button>
                            <button wire:click="setStatus({{ $movement->id }}, 'delivering')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs"> <!--En este botón se llama a la función set status enviando como parámetro el id dell movimiento y cambia los estados del arma y del cargador asignado a ese movimiento a estado en entrega (delivering)-->
                                En Entrega
                            </button>
                            <button wire:click="setStatus({{ $movement->id }}, 'delivered')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs"><!--En este botón se llama a la función set status enviando como parámetro el id dell movimiento y cambia los estados del arma y del cargador asignado a ese movimiento a estado entregado (delivered)-->
                                Entregado
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $movements->links() }}
    </div>
</div>
