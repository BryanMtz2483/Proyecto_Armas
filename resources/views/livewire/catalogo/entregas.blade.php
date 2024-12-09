<div>
    <!--Div que contiene el CRUD completo del modelo de Movements-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-label class="text-lg-center text-center text-5xl text-red-900" style="font-family: Georgia, 'Times New Roman', Times, serif">REGISTRAR MOVIMIENTOS</x-label> <br>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                @livewire('c-r-u-d-controller', ['modelName' => 'Movement'])
            </div>
        </div>
    </div>
    <!--Div que contiene la funcionalidad de entrega de armas después de 12 horas de registro-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-label class="text-lg-center text-center text-5xl text-red-900" style="font-family: Georgia, 'Times New Roman', Times, serif">MOVIMIENTOS (Más de 12 horas)</x-label> <br>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                @livewire('catalogo.admin-entrega')
            </div>
        </div>
    </div>
    
</div>
