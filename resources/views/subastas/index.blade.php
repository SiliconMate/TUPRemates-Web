<x-home-layout>
    <div class="container mx-auto px-4 my-8">
        <div class="flex">
            <x-home.sidebar-filtrado />

            <div class="w-3/4 p-4">
                <div class="flex justify-between items-center text-center mb-4 ">
                    <h2 class="font-bold text-2xl">Todas las Subastas</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($subastas as $subasta)
                    <a href="{{ route('subastas.show', $subasta) }}" class="block bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <h3 class="font-bold text-2xl">{{ $subasta->nombre }}</h3>
                        <p class="text-gray-600">{{ $subasta->descripcion }}</p>
                        <p class="text-gray-500">Apertura:
                            {{ \Carbon\Carbon::parse($subasta->fecha_apertura)->format('d m Y - H:i') }}
                        </p>
                        <p class="text-gray-500">Cierre: {{ \Carbon\Carbon::parse($subasta->fecha_cierre)->format('d m Y - H:i') }} </p>
                        <p class="text-gray-500">Categoría: {{ $subasta->categoria->nombre }} </p>
                        @if ($subasta->fecha_cierre < now())
                            <span class="text-sm text-slate-100 bg-gray-600 px-2 rounded-lg">
                                Cerrada
                            </span>
                        @else
                            <span class="text-sm text-slate-100 bg-blue-600 px-2 rounded-lg">
                                Abierta
                            </span>
                        @endif
                    </a> 
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $subastas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-home-layout>