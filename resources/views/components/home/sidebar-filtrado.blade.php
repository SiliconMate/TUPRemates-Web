@php
    $categorias = App\Models\Categoria::all();
@endphp

<div class="w-1/4 p-6 bg-blue-100 shadow-lg rounded-lg h-full">
    <h2 class="flex items-center text-xl font-bold mb-6 text-gray-800">
        <i class="ti ti-filter text-2xl mr-2"></i>
        Filtrar
    </h2>
    <form method="GET" action="{{ route('subastas.index') }}" id="filterForm">

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Nombre</h3>
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Buscar..." class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Categorías</h3>
            <ul class="space-y-2">
                @foreach ($categorias as $categoria)
                <li>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="categoria" value="{{ $categoria->id }}" class="form-radio text-blue-600" onchange="document.getElementById('filterForm').submit()" {{ request('categoria') == $categoria->id ? 'checked' : '' }}>
                        <span class="text-gray-600">{{ $categoria->nombre }}</span>
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Estado</h3>
            <ul class="space-y-2">
                <li>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="estado" value="creada" class="form-radio text-blue-600" onchange="document.getElementById('filterForm').submit()" {{ request('estado') == 'creada' ? 'checked' : '' }}>
                        <span class="text-gray-600">Recien Creada</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="estado" value="activa" class="form-radio text-blue-600" onchange="document.getElementById('filterForm').submit()" {{ request('estado') == 'activa' ? 'checked' : '' }}>
                        <span class="text-gray-600">Activo</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="estado" value="cerrada" class="form-radio text-blue-600" onchange="document.getElementById('filterForm').submit()" {{ request('estado') == 'cerrada' ? 'checked' : '' }}>
                        <span class="text-gray-600">Finalizado</span>
                    </label>
                </li>
            </ul>
        </div>
    </form>
</div>