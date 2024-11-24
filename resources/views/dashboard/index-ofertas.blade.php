<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Ofertas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($ofertas as $oferta)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                            <h3 class="font-bold text-2xl">{{ $oferta->producto->titulo }}</h3>
                            <p class="text-gray-500">Suma ofertada: ${{ $oferta->monto }}</p>
                            <p class="text-gray-500">Fecha de la Oferta: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d m Y - H:i') }} </p>
                        </div>
                        @endforeach                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
