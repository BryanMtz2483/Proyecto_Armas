<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-label class="text-lg-center text-center text-7xl text-red-900" style="font-family: Georgia, 'Times New Roman', Times, serif">INFORMES</x-label>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                <br>
                <x-button wire:click="set('dashModal','Bases')" class="ml-10">BASES</x-button> 
                <x-button wire:click="set('dashModal','Ranks')">RANKS</x-button> 
                <x-button wire:click="set('dashModal','Credentials')">CREDENTIALS</x-button> 
                <x-button wire:click="set('dashModal','WeaponType')">WEAPON TYPE</x-button> 
                <x-button wire:click="set('dashModal','Weapon')">WEAPON</x-button> 
                <x-button wire:click="set('dashModal','WeaponLicense')">WEAPON LICENCE </x-button> 
                <x-button wire:click="set('dashModal','Military')">MILITARY</x-button> 
                <x-button wire:click="set('dashModal','Magazine')">MAGAZINE</x-button> 
                <x-button wire:click="set('dashModal','Movement')">MOVEMENTS</x-button> 
                <br><br>
                @if($dashModal == 'Bases')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Base'])
                    </div>
                @elseif($dashModal == 'Ranks')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Rank'])
                    </div>
                @elseif($dashModal == 'Credentials')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Credential'])
                    </div>
                @elseif($dashModal == 'WeaponType')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'WeaponType'])
                    </div>
                @elseif($dashModal == 'Weapon')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Weapon'])
                    </div>
                @elseif($dashModal == 'WeaponLicense')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'WeaponLicense'])
                    </div>
                @elseif($dashModal == 'Military')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Military'])
                    </div>
                @elseif($dashModal == 'Magazine')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Magazine'])
                    </div>
                @elseif($dashModal == 'Movement')
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 relative overflow-x-auto shadow-md sm:rounded-l border-cyan-500">
                        @livewire('c-r-u-d-controller', ['modelName' => 'Movement'])
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
