<x-home-layout>
    <div class="container mx-auto px-4 my-8">
        <div class="flex">
            <!-- Sidebar -->
            <x-home.sidebar-filtrado />
            <!-- Subastas y productos -->
            <div class="w-3/4 p-4">
                {{-- subastas destacadas --}}
                <div class="flex justify-between items-center text-center mb-4 ">
                    <h2 class="font-bold text-2xl">
                        <i class="ti ti-flame text-red-600"></i>Subastas Recientes
                    </h2>
                    <a href="{{ route('subastas.index') }}" class="text-blue-500">Ver todas</a>
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
                        @if ($subasta->estado == 'creada')
                        <span class="text-sm text-slate-100 bg-gray-600 px-2 rounded-lg">Creada</span>
                        @elseif ($subasta->estado == 'activa')
                        <span class="text-sm text-slate-100 bg-blue-600 px-2 rounded-lg">Activa</span>
                        @elseif ($subasta->estado == 'cerrada')
                        <span class="text-sm text-slate-100 bg-red-400 px-2 rounded-lg">Cerrada</span>
                        @endif
                    </a> 
                    @endforeach
                </div>
                {{-- productos destacados --}}
                <div class="flex justify-between items-center text-center mt-8 mb-4">
                    <h2 class="font-bold text-2xl">Productos Destacados</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($productos as $producto)
                    <a href="{{ route('productos.show', $producto) }}" class="block bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{Storage::disk('azure')->url('productos/' .$producto->imagenes->first()->url)}}"
                                 width="250px"
                                 height="250px"
                                 alt="{{$producto->imagenes->first()->url}}"
                                 class="object-cover w-full aspect-square">
                            <h3 class="font-bold text-2xl px-4">{{ $producto->titulo }}</h3>
                            <p class="text-gray-500 px-4">Precio inicial: ${{ $producto->precio_base }}</p>
                            <hr class="pb-1 px-4">
                            <div class="">
                                <p class="text-gray-500 px-4">Valor actual:</p>
                                <p class="text-2xl font-bold text-gray- mb-1 px-4">${{ $producto->usuariosOferentes->count() ? $producto->usuariosOferentes->max('pivot.monto') : $producto->precio_base }}</p>
                            </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-home-layout>