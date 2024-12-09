<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        MILITARY ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        WEAPON CODE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        MAGAZINE CODE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DATE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ACCIONES
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($registers as $register)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$register -> military_id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$register -> weapon_code}}
                    </td>
                    <td class="px-6 py-4">
                        {{$register -> magazine_code}}
                    </td>
                    <td class="px-6 py-4">
                        {{$register -> date}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="stateDelivered({{ $register->id }})">MARCAR COMO ENTREGADO</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
