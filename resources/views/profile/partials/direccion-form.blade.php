
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información de Dirección') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza tu información de dirección.") }}
        </p>
    </header>

    <form method="post" action="{{ route('address.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="calle" :value="__('Calle')" />
                <x-text-input id="calle" name="calle" type="text" class="mt-1 block w-full" :value="old('calle', $user->direcciones()->first()->calle ?? '')" required autofocus autocomplete="calle" />
                <x-input-error class="mt-2" :messages="$errors->get('calle')" />
            </div>
    
            <div>
                <x-input-label for="numero" :value="__('Numero')" />
                <x-text-input id="numero" name="numero" type="text" class="mt-1 block w-full" :value="old('numero', $user->direcciones()->first()->numero?? '')" required autocomplete="numero" />
                <x-input-error class="mt-2" :messages="$errors->get('numero')" />
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="piso" :value="__('Piso (opcional)')" />
                <x-text-input id="piso" name="piso" type="text" class="mt-1 block w-full" :value="old('piso', $user->direcciones()->first()->piso ?? '')" autocomplete="piso" />
                <x-input-error class="mt-2" :messages="$errors->get('piso')" />
            </div>
    
            <div>
                <x-input-label for="departamento" :value="__('Departamento (Opcional)')" />
                <x-text-input id="departamento" name="departamento" type="text" class="mt-1 block w-full" :value="old('departamento', $user->direcciones()->first()->departamento ?? '')" autocomplete="departamento" />
                <x-input-error class="mt-2" :messages="$errors->get('departamento')" />
            </div>
        </div>
        

        <div class="grid grid-cols-3 gap-4">
            <div>
                <x-input-label for="localidad" :value="__('Localidad')" />
                <x-text-input id="localidad" name="localidad" type="text" class="mt-1 block w-full" :value="old('localidad', $user->direcciones()->first()->localidad ?? '')" required autocomplete="localidad" />
                <x-input-error class="mt-2" :messages="$errors->get('localidad')" />
            </div>

            <div>
                <x-input-label for="provincia" :value="__('Provincia')" />
                <x-text-input id="provincia" name="provincia" type="text" class="mt-1 block w-full" :value="old('provincia', $user->direcciones()->first()->provincia ?? '')" required autocomplete="provincia" />
                <x-input-error class="mt-2" :messages="$errors->get('provincia')" />
            </div>
    
            <div>
                <x-input-label for="codigo_postal" :value="__('Codigo Postal')" />
                <x-text-input id="codigo_postal" name="codigo_postal" type="text" class="mt-1 block w-full" :value="old('codigo_postal', $user->direcciones()->first()->codigo_postal ?? '')" required autocomplete="codigo_postal" />
                <x-input-error class="mt-2" :messages="$errors->get('codigo_postal')" />
            </div>
        </div>
        
        <div>
            <x-input-label for="telefono" :value="__('Celular')" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->direcciones()->first()->telefono ?? '')" required autocomplete="telefono" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>