<x-home-layout>

    <div class="container mx-auto px-4">
        <div class="flex flex-col mx-auto px-16">

            <div class="">
                <h1 class="text-4xl font-extrabold text-gray-800">{{ strtoupper($subasta->nombre) }}</h1>
                <p class="text-gray-600 text-xl mb-6">{{ $subasta->descripcion }}</p>

                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-event"></i>
                    Fecha: {{ $subasta->fecha_apertura }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-stats"></i>
                    Fecha de cierre: {{ $subasta->fecha_cierre }}
                </p>
                <p class="text-gray-600 text-xl">Categoría: {{ $subasta->categoria->nombre }}</p>
            </div>
        
            <div class="container mx-auto py-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Productos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($productos as $producto)
                        <a href="{{ route('productos.show', $producto) }}" class="block bg-white shadow-md rounded-lg overflow-hidden p-4">
                            <img src="{{Storage::disk('azure')->url($producto->imagenes->first()->url)}}"
                                 width="250px"
                                 alt="{{$producto->imagenes->first()->url}}">
                            <h3 class="font-bold text-2xl">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600">{{ $producto->descripcion }}</p>
                            <p class="text-gray-500">Precio inicial: ${{ $producto->precio_inicial }}</p>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $productos->links() }}
                </div>
            </div>

        </div>
    </div>
    

</x-home-layout>