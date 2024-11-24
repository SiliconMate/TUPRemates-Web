<x-modal name="publicar-producto" :show="$errors->any()" focusable>
    <form method="post" action="{{ route('subastas.publicar-producto') }}" class="p-6" enctype="multipart/form-data">
        @csrf
            
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                <i class="text-2xl ti ti-file-plus"></i>
                {{ __('Publicar Producto') }}
            </h2>
        </header>

        {{-- campo hidden que pase la subasta en la que se está --}}
        <input type="hidden" name="subasta_id" value="{{ $subasta->id }}">
            
        <div class="grid grid-cols-2 gap-4">
            <div class="mt-4">
                {{-- titulo --}}
                <x-input-label for="titulo" :value="__('Titulo')" />
                <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo')" required autofocus />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>
            <div class="mt-4">
                {{-- precio_base --}}
                <x-input-label for="precio_base" :value="__('Precio Base')" />
                <x-text-input id="precio_base" class="block mt-1 w-full" type="number" name="precio_base" :value="old('precio_base')" required />
                <x-input-error :messages="$errors->get('precio_base')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            {{-- descripcion --}}
            <x-input-label for="descripcion" :value="__('Descripcion')" />
            <textarea id="descripcion" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1" name="descripcion" required>{{ old('descripcion') }}</textarea>
        </div>

        <div x-data="imageUploader()" class="mt-4">
            <x-input-label for="categoria" :value="__('Imagenes')" />
            <div class="flex items-center justify-center w-full mt-1">
                <label for="imagenes[]" 
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="imagenes[]" name="imagenes[]" type="file" class="hidden" multiple 
                        @change="addImages($event)" />
                </label>
            </div> 
            <x-input-error :messages="$errors->get('imagenes.*')" class="mt-2" />

            <div class="grid grid-cols-3 gap-4 mt-4" x-show="images.length > 0">
                <template x-for="(image, index) in images" :key="index">
                    <div class="relative w-full h-32 border rounded-lg">
                        <img :src="image" alt="Uploaded Image" class="object-cover w-full h-full rounded-lg" />
                        <button @click="removeImage(index)" 
                                class="absolute top-2 right-2 bg-red-600 text-white rounded-full px-2 py-1 text-xs">
                            X
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button class="ms-3">
                Solicitar
            </x-primary-button>
        </div>
    </form>
</x-modal>

<script>
    function imageUploader() {
        return {
            images: [],
            addImages(event) {
                const files = event.target.files;
                for (let file of files) {
                    this.images.push(URL.createObjectURL(file));
                }
            },
            removeImage(index) {
                this.images.splice(index, 1);
            }
        };
    }
</script>
