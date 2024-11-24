<x-home-layout>
    <div class="container mx-auto px-4">
        <div class="flex flex-col mx-auto px-16">

            <div class="mb-6">
                <h1 class="text-4xl font-extrabold text-gray-800">{{ strtoupper($producto->subasta->nombre) }}</h1>
                <p class="text-gray-600 text-xl mb-6">{{ $producto->subasta->descripcion }}</p>

                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-event"></i>
                    Fecha: {{ $producto->subasta->fecha_apertura }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-stats"></i>
                    Fecha de cierre: {{ $producto->subasta->fecha_cierre }}
                </p>
                <p class="text-gray-600 text-xl">Categoría: {{ $producto->subasta->categoria->nombre }}</p>
            </div>

            <div class="flex items-center text-center font-extrabold text-blue-500 mb-6">
                <i class="ti ti-arrow-left mr-2"></i>
                <a href="{{ route('subastas.show', $producto->subasta) }}">Volver a la subasta</a>
            </div>

            <div class="flex flex-col">
                <h1 class="text-2xl font-extrabold text-gray-800">{{ strtoupper($producto->titulo) }}</h1>
                
                <div class="flex justify-center">
                    <div class="w-[60%]">
                        <img src="{{Storage::disk('azure')->url('productos/' . $producto->imagenes->first()->url)}}"
                            width="500px"
                            class="mx-auto"
                            alt="{{$producto->imagenes->first()->url}}">
                    </div>
                    <div class="w-[40%] px-2">
                        <div class="bg-white shadow-md border border-blue-800 border-opacity-10 rounded-sm px-6 py-5">
                            <div class="flex flex-col">

                                @php
                                $fechaCierre = \Carbon\Carbon::parse($producto->subasta->fecha_cierre);
                                $diferencia = $fechaCierre->diff(\Carbon\Carbon::now());
                                @endphp

                                <p class="text-sm text-gray-500 font-medium">CIERRA:</p>
                                <div class="flex flex-col">
                                    <p class="text-lg font-semibold text-gray-800 flex justify-between">
                                        @if ($fechaCierre->isPast())
                                            <span class="text-red-800">Cerrado</span>
                                        @else
                                            <span class="text-blue-800">{{ $diferencia->d ? $diferencia->d : '0' }}</span> días
                                            <span class="text-gray-600"> | </span>
                                            <span class="text-blue-800">{{ $diferencia->h }}</span> horas
                                            <span class="text-gray-600"> | </span>
                                            <span class="text-blue-800">{{ $diferencia->i }}</span> minutos
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Fecha de cierre: {{ $producto->subasta->fecha_cierre }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between text-sm text-gray-500">
                                    <p>Vendedor:</p>
                                    <p class="font-medium text-gray-800">{{ $producto->solicitado_por()->first()->name }}</p>
                                </div>
                                <hr>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <p>Participantes:</p>
                                    <p class="font-medium text-gray-800">{{ $producto->usuariosOferentes->unique('id')->count() }}</p>
                                </div>
                                <hr>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <p>Ofertas:</p>
                                    <p class="font-medium text-gray-800">{{ $producto->usuariosOferentes->count() }}</p>
                                </div>
                                <hr>
                            </div>

                            <div class="mt-6">
                                <p class="text-sm text-gray-500">Oferta Inicial:</p>
                                <p class="text-2xl font-bold text-gray- mb-1">${{ $producto->precio_base }}</p>
                                <p class="text-sm text-gray-500">Oferta Actual:</p>
                                <p class="text-2xl font-bold text-gray- mb-1">${{ $producto->usuariosOferentes->count() ? $producto->usuariosOferentes->max('pivot.monto') : $producto->precio_base }}</p>
                            </div>

                            <div class="flex flex-row items-center">
                                <p class="text-sm text-gray-500 mr-2">Ganador Actual:</p>
                                <p class="text-sm font-medium text-gray-800"> {{ $producto->usuariosOferentes->count() ? substr($producto->usuariosOferentes->where('pivot.monto', $producto->usuariosOferentes->max('pivot.monto'))->first()->name, 0, 2) . str_repeat('*', strlen($producto->usuariosOferentes->where('pivot.monto', $producto->usuariosOferentes->max('pivot.monto'))->first()->name) - 2) : 'Sin ofertas' }}</p>
                            </div>
                            <hr>

                            <form action="{{ route('productos.ofertar') }}" method="POST" class="mt-6 flex flex-col items-center">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <div class="flex w-full">
                                    <input type="number" name="monto" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Ingrese su oferta" required>
                                    <button type="submit"
                                            class="ml-4 bg-blue-800 text-white font-semibold py-2 px-4 rounded-md cursor-pointer"
                                            @disabled( ($producto->subasta->fecha_cierre < now()) || !Auth::check() )>
                                        Participar
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('monto')" class="mt-2 w-full" />
                            </form>

                            @if (session('status'))
                                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mt-4" role="alert">
                                    <p>{{ session('status') }}</p>
                                </div>
                            @endif

                            <div class="flex items-center mt-4 justify-end">
                                @if ($producto->subasta->fecha_cierre < now())
                                    <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
                                    <span class="text-blue-500 text-sm ml-1">Subasta cerrada</span>
                                @elseif (!Auth::check())
                                    <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
                                    <span class="text-blue-500 text-sm">Tienes que estar logueado</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <h1 class=" mt-6 text-2xl font-extrabold text-gray-800">Descripción detallada</h1>
                <p class="text-xl text-gray-800">{{ $producto->descripcion }}</p>
            </div>

            <div class="mt-6">
                <h1 class="text-xl font-bold text-gray-800">CLASIFICACIÓN DE OFERTAS</h1>
                <div class="flex justify-between mb-2">
                    <p class="font-medium text-gray-800">CONSOLIDACIÓN DE OFERTAS</p>
                    <p class="text-sm text-gray-600">TOTAL: {{ $producto->usuariosOferentes->unique('id')->count() }} COMPRADOR(ES)</p>
                </div>
                <table class="w-full text-left border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">USUARIO</th>
                            <th class="border border-gray-300 px-4 py-2">CANTIDAD DE OFERTAS</th>
                            <th class="border border-gray-300 px-4 py-2">TIPO DE OFERTA</th>
                            <th class="border border-gray-300 px-4 py-2">VALOR DE LA OFERTA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($producto->usuariosOferentes as $oferta)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ substr($oferta->name, 0, 2) . str_repeat('*', strlen($oferta->name) - 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center"> arreglar esto </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ App\Models\FormaPago::find($oferta->pivot->forma_pago_id)->nombre }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">${{ $oferta->pivot->monto }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 px-4 py-2">No hay ofertas disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-home-layout>