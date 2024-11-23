<footer class="py-8 text-center text-sm text-black dark:text-white/70 bg-blue-100">
    
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 md:px-16">
        <div>
            <h3 class="font-bold text-lg mb-4 flex justify-center text-center">
                <i class="ti ti-briefcase text-xl mr-2"></i>
                Sobre la empresa
            </h3>
            <ul class="space-y-2">
                <li><a href="{{ route('sobre-nosotros') }}" class="hover:text-blue-500">¿Quiénes somos?</a></li>
                <li><a href="#" class="hover:text-blue-500">Dónde encontrarnos</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-4 flex justify-center text-center">
                <i class="ti ti-category-2 text-xl mr-2"></i>
                Categorías
            </h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-blue-500">Inmuebles</a></li>
                <li><a href="#" class="hover:text-blue-500">Autos y motos</a></li>
                <li><a href="#" class="hover:text-blue-500">Camiones y autobuses</a></li>
                <li><a href="#" class="hover:text-blue-500">Todas las Categorías</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-4 flex justify-center text-center">
                <i class="ti ti-help text-xl mr-2"></i>
                Ayuda
            </h3>
            <ul class="space-y-2">
                <li><a href="{{ route('como-participar') }}" class="hover:text-blue-500">¿Cómo comprar?</a></li>
                <li><a href="{{ route('como-participar') }}" class="hover:text-blue-500">Quiero vender</a></li>
                <li><a href="#" class="hover:text-blue-500">Política de Calidad</a></li>
                <li><a href="#" class="hover:text-blue-500">Ayuda</a></li>
            </ul>
        </div>
    </section>

    <section class="mt-8 px-4 md:px-16">
        <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
            2024 TUP Remates © • Av. calle de ejemplo 878 1° piso, Goya, Provincia de Corrinetes. A9243CSC. • +54 (3777) 1234-5678 • 
            <a href="#" class="hover:text-blue-500">Términos y políticas</a> • 
            <a href="#" class="hover:text-blue-500">Política de Calidad</a>
        </p>
    </section>

</footer>