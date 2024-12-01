<x-home-layout>
    <div class="container mx-auto px-4 my-8">
        <div class="flex flex-col mx-auto px-16">

            <div class="mb-6">
                <h1 class="text-4xl font-extrabold text-gray-800">{{ strtoupper($producto->subasta->nombre) }}</h1>
                <p class="text-gray-600 text-xl mb-6">{{ $producto->subasta->descripcion }}</p>

                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-event"></i>
                    <b>Inicio:</b> {{ $producto->subasta->fecha_apertura }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-calendar-stats"></i>
                    <b>Cierre:</b> {{ $producto->subasta->fecha_cierre }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-truck"></i>
                    <b>Envios:</b> {{ $producto->subasta->metodosEnvio->pluck('nombre')->join(', ') }}
                </p>
                <p class="text-gray-600 text-xl">
                    <i class="ti ti-tag"></i>
                    <b>Categoría:</b> {{ $producto->subasta->categoria->nombre }}
                </p>
            </div>

            <div class="flex items-center text-center font-extrabold text-blue-500 mb-6">
                <i class="ti ti-arrow-left mr-2"></i>
                <a href="{{ route('subastas.show', $producto->subasta) }}">Volver a la subasta</a>
            </div>

            <div class="flex flex-col">
                <h1 class="text-2xl font-extrabold text-gray-800 mb-8">{{ strtoupper($producto->titulo) }}</h1>
                
                <div class="flex justify-center">
                    <div class="w-[60%] mx-auto">
                        <img id="main-image" src="{{ Storage::disk('azure')->url('productos/' . $producto->imagenes->first()->url) }}" 
                             alt="{{ $producto->imagenes->first()->url }}" 
                             class="mx-auto transition-all duration-500 ease-in-out w-full max-w-lg border border-gray-300 rounded-lg">
                    
                        <div class="flex justify-center gap-2 mt-4">
                            @foreach ($producto->imagenes as $imagen)
                                <img src="{{ Storage::disk('azure')->url('productos/' . $imagen->url) }}" 
                                     alt="{{ $imagen->url }}" 
                                     class="w-20 h-20 object-cover cursor-pointer border-2 border-transparent hover:border-blue-600 rounded-md"
                                     onclick="changeMainImage('{{ Storage::disk('azure')->url('productos/' . $imagen->url) }}')">
                            @endforeach
                        </div>
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

                                <div class="grid grid-cols-2 gap-2">
                                    <div class="">
                                        <input type="number" name="monto" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Ingrese su oferta" required>
                                        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                                    </div>
                                    <div class="">
                                        <select name="forma_pago_id" class="border border-gray-300 rounded-md p-2 w-full" required>
                                            <option value="" selected disabled>Forma de pago</option>
                                            @foreach (App\Models\SubastaFormaPago::with('formaPago')->where('subasta_id', $producto->subasta->id)->get() as $item)
                                                <option value="{{ $item->formaPago->id }}">{{ $item->formaPago->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="flex w-full justify-end mt-2">
                                    <button type="submit"
                                            class="ml-4 bg-blue-800 text-white font-semibold py-2 px-4 rounded-md cursor-pointer"
                                            @disabled( ($producto->subasta->fecha_cierre < now()) || !Auth::check() )
                                            @disabled( ($producto->subasta->getOriginal('estado') === "creada") || !Auth::check() )>
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
                                    <span class="text-blue-500 text-sm ml-1">Subasta finalizada</span>
                                @elseif (!Auth::check())
                                    <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
                                    <span class="text-blue-500 text-sm">Tienes que estar logueado</span>
                                @elseif ($producto->subasta->getOriginal('estado') === 'creada')
                                    <i class="text-blue-500 text-sm ml-4 ti ti-alert-octagon"></i>
                                    <span class="text-blue-500 text-sm">La subasta aún no está abierta</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <h1 class=" mt-6 text-2xl font-extrabold text-gray-800">Descripción detallada</h1>
                <p class="text-xl text-gray-800">{{ $producto->descripcion }}</p>
            </div>



            <div class="mt-16 mb-2 flex flex-col">
                <div class="flex justify-between px-2 py-1 bg-gray-200">
                    <p class="text-md font-bold text-gray-800">CLASIFICACIÓN DE OFERTAS</p>
                    <p class="text-sm text-gray-700">TOTAL: {{ $producto->usuariosOferentes->unique('id')->count() }} COMPRADOR(ES)</p>
                </div>

                <div class="my-2">
                    <div class="flex justify-center my-3">
                        <p class="text-sm font-bold text-gray-800">OFERTA GANADORA</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">USUARIO</th>
                                    <th class="px-4 py-2 border border-gray-300">FECHA</th>
                                    <th class="px-4 py-2 border border-gray-300">TIPO DE OFERTA</th>
                                    <th class="px-4 py-2 border border-gray-300">VALOR DE LA OFERTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $highestOffer = $producto->usuariosOferentes->sortByDesc('pivot.monto')->first();
                                @endphp
                                @if ($highestOffer)
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ substr($highestOffer->name, 0, 2) . str_repeat('*', strlen($highestOffer->name) - 2) }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $highestOffer->pivot->created_at }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ App\Models\FormaPago::find($highestOffer->pivot->forma_pago_id)->nombre }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ number_format($highestOffer->pivot->monto, 2, ',', '.') }} $</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500 px-4 py-2">No hay ofertas disponibles</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="my-2">
                    <div class="flex justify-center my-3">
                        <p class="text-sm font-bold text-gray-800">ÚLTIMAS OFERTAS</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">USUARIO/UBICACIÓN</th>
                                    <th class="px-4 py-2 border border-gray-300">FECHA</th>
                                    <th class="px-4 py-2 border border-gray-300">TIPO DE OFERTA</th>
                                    <th class="px-4 py-2 border border-gray-300">VALOR DE LA OFERTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($producto->usuariosOferentes->sortByDesc('pivot.created_at')->take(5) as $oferta)
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ substr($oferta->name, 0, 2) . str_repeat('*', strlen($oferta->name) - 2) }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $oferta->pivot->created_at }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ App\Models\FormaPago::find($oferta->pivot->forma_pago_id)->nombre }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ number_format($oferta->pivot->monto, 2, ',', '.') }} $</td>
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

                <div class="my-2">
                    <div class="flex justify-center my-3">
                        <p class="text-sm font-bold text-gray-800">CONSOLIDACIÓN DE OFERTAS</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">USUARIO</th>
                                    <th class="px-4 py-2 border border-gray-300">CANTIDAD DE OFERTAS</th>
                                    <th class="px-4 py-2 border border-gray-300">TIPO DE OFERTA</th>
                                    <th class="px-4 py-2 border border-gray-300">VALOR DE LA OFERTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($producto->usuariosOferentes->groupBy('id') as $usuarioId => $ofertas)
                                    @php
                                        $usuario = $ofertas->first();
                                        $cantidadOfertas = $ofertas->count();
                                        $ultimaOferta = $ofertas->sortByDesc('pivot.created_at')->first();
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ substr($usuario->name, 0, 2) . str_repeat('*', strlen($usuario->name) - 2) }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $cantidadOfertas }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ App\Models\FormaPago::find($ultimaOferta->pivot->forma_pago_id)->nombre }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ number_format($ultimaOferta->pivot->monto, 2, ',', '.') }} $</td>
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

        </div>
    </div>

    <script>
        function changeMainImage(imageUrl) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = imageUrl;
        }
    </script>
    

    <style>
        #main-image {
            max-height: 400px;
        }
        img {
            transition: transform 0.2s ease-in-out;
        }
        img:hover {
            transform: scale(1.05);
        }
    </style>

</x-home-layout>