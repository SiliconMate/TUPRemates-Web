@php
    $categorias = App\Models\Categoria::all();
@endphp

<div class="w-1/4 p-6 bg-blue-100 shadow-lg rounded-lg h-full">
    <h2 class="flex items-center text-xl font-bold mb-6 text-gray-800">
        <i class="ti ti-filter text-2xl mr-2"></i>
        Filtrar
    </h2>
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Categorías</h3>
        <ul class="space-y-2">
            @foreach ($categorias as $categoria)
            <li>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="categoria" value="{{ $categoria->id }}" class="form-radio text-indigo-600">
                    <span class="text-gray-600">{{ $categoria->nombre }}</span>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Estado</h3>
        <ul class="space-y-2">
            <li><a href="#" class="text-indigo-600 hover:underline">Activo</a></li>
            <li><a href="#" class="text-indigo-600 hover:underline">Finalizado</a></li>
        </ul>
    </div>
</div>