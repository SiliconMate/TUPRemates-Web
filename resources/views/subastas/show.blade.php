<x-home-layout>

    <div class="container mx-auto px-4">
        <div class="flex flex-col mx-auto px-16">

            <div class="flex items-center text-center font-extrabold text-blue-500 mb-6">
                <i class="ti ti-arrow-left mr-2"></i>
                <a href="{{ route('subastas.index') }}">Volver al listado</a>
            </div>

            <div class="">
                <h1 class="text-4xl font-extrabold text-gray-800">{{ strtoupper($subasta->nombre) }} - {{ $subasta->categoria->nombre }}</h1>
                <p class="text-gray-600 text-xl mb-6">{{ $subasta->descripcion }}</p>

                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-event"></i>
                    <b>Inicio</b> {{ $subasta->fecha_apertura }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-stats"></i>
                    <b>Cierre</b> {{ $subasta->fecha_cierre }}
                </p>
            </div>

            <div class="">
                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'publicar-producto')"
                    class="bg-blue-700 text-white font-extrabold py-2 px-4 rounded mt-6 inline-block cursor-pointer"
                    @disabled( ($subasta->fecha_cierre < now()) || !Auth::check() )
                    >
                Publicar Producto
            </button>
            @include('subastas.partials.publicar-producto-modal', ['subasta' => $subasta])
            
            @if ($subasta->fecha_cierre < now())
            <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
            <span class="text-blue-500 text-sm ml-1">Subasta cerrada</span>
            @elseif (!Auth::check())
                <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
                <span class="text-blue-500 text-sm">Tienes que estar logueado</span>
            @endif
            @if (session('status'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mt-4" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            </div>
        
            <div class="container mx-auto py-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Productos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                <div class="mt-12">
                    {{ $productos->links() }}
                </div>
            </div>

        </div>
    </div>
    

</x-home-layout>