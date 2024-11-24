<x-guest-layout>
    <div class="px-2" x-data="{ accountType: null }" x-init="accountType = null">
        <div class="mt-4 mb-2">
            <x-input-label for="type" :value="__('De que tipo es la cuenta')" />
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="type" value="fisica" x-model="accountType">
                    <span class="ml-2">Persona Física</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" class="form-radio" name="type" value="juridica" x-model="accountType">
                    <span class="ml-2">Persona Juridica</span>
                </label>
            </div>
        </div>
    
        <hr class="pb-4">
    
        <form method="POST" action="{{ route('register') }}" x-show="accountType === 'fisica'" x-cloak>
            @csrf

            <input type="hidden" name="type" value="fisica">
    
            <div class="text-lg mb-2 font-bold">
                <p>Datos de acceso</p>
            </div>

            <!-- Usuario -->
            <div>
                <x-input-label for="name" :value="__('Nombre de Usuario')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                {{-- Telefono --}}
                <div class="mt-4">
                    <x-input-label for="telefono" :value="__('Teléfono')" />
                    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="telefono" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
            </div>
    
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
        
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="text-lg mt-4 font-bold">
                <p>Datos de la persona</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Campo: Nombre -->
                <div class="mt-4">
                    <x-input-label for="nombre" :value="__('Nombre')" />
                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autocomplete="nombre" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                 <!-- Campo: Apellido -->
                <div class="mt-4">
                    <x-input-label for="apellido" :value="__('Apellido')" />
                    <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autocomplete="apellido" />
                    <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-4">
                <!-- Campo: tipo_documento -->
                <div class="mt-4">
                    <x-input-label for="tipo_documento" :value="__('Tipo de Documento')" />
                    <select id="tipo_documento" name="tipo_documento" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                        <option value="DNI">DNI</option>
                        <option value="Pasaporte">Pasaporte</option>
                        <option value="Cedula">Cédula</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <x-input-error :messages="$errors->get('tipo_documento')" class="mt-2" />
                </div>
                <!-- Campo: numero_documento -->
                <div class="mt-4">
                    <x-input-label for="numero_documento" :value="__('Número')" />
                    <x-text-input id="numero_documento" class="block mt-1 w-full" type="text" name="numero_documento" :value="old('numero_documento')" required autocomplete="numero_documento" />
                    <x-input-error :messages="$errors->get('numero_documento')" class="mt-2" />
                </div>
                <!-- Campo: fecha_nacimiento -->
                <div class="mt-4">
                    <x-input-label for="fecha_nacimiento" :value="__('Nacimiento')" />
                    <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" required autocomplete="bday" />
                    <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                </div>
            </div>

            {{-- Campo: Sexo que sea un select entre M, F, X --}}
            <div class="mt-4 w-1/3">
                <x-input-label for="sexo" :value="__('Sexo')" />
                <select id="sexo" name="sexo" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="X">Otro</option>
                </select>
                <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
    
        </form>
    
        <form method="POST" action="{{ route('register') }}" x-show="accountType === 'juridica'" x-cloak>
            @csrf
    
            <input type="hidden" name="type" value="juridica">
    
            <div class="text-lg mb-2 font-bold">
                <p>Datos de acceso</p>
            </div>

            <!-- Usuario -->
            <div>
                <x-input-label for="name" :value="__('Nombre de Usuario')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                {{-- Telefono --}}
                <div class="mt-4">
                    <x-input-label for="telefono" :value="__('Teléfono')" />
                    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="telefono" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
            </div>
    
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
        
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="text-lg mt-4 font-bold">
                <p>Datos de la Empresa</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Campo: CUIT -->
                <div class="mt-4">
                    <x-input-label for="cuit" :value="__('CUIT')" />
                    <x-text-input id="cuit" class="block mt-1 w-full" type="text" name="cuit" :value="old('cuit')" required autocomplete="cuit" />
                    <x-input-error :messages="$errors->get('cuit')" class="mt-2" />
                </div>
                <!-- Campo: Tipo de Sociedad -->
                <div class="mt-4">
                    <x-input-label for="tipo_sociedad" :value="__('Tipo de Sociedad')" />
                    <select id="tipo_sociedad" name="tipo_sociedad" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                        <option value="SA">SA</option>
                        <option value="SRL">SRL</option>
                        <option value="SCA">SCA</option>
                        <option value="SAC">SAC</option>
                        <option value="OTRA">OTRA</option>
                    </select>
                    <x-input-error :messages="$errors->get('tipo_sociedad')" class="mt-2" />
                </div>
            </div>

            <!-- Campo: Razon Social -->
            <div class="mt-4">
                <x-input-label for="razon_social" :value="__('Razón Social')" />
                <x-text-input id="razon_social" class="block mt-1 w-full" type="text" name="razon_social" :value="old('razon_social')" required autocomplete="razon_social" />
                <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
    
        </form>

        {{-- mostrar un mensaje de errorer que viene de aca return redirect()->route('register')->withErrors(['registration' => 'There was an error with your registration. Please try again.']); --}}
        @if ($errors->any())
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

    </div>

</x-guest-layout>
