<x-home-layout>

    <section class="bg-[rgb(59,82,138)] p-8">
        <h1 class="text-3xl font-bold text-center text-slate-100">
            Sobre Nosotros
        </h1>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-4 p-8">
        <div class="px-14 lg:px-32 py-6">
            <img src="{{ asset("images/sobre-nosotros.webp") }}" alt="Imagen de la empresa" class="w-full">
        </div>
        <div class="flex items-center">
            <p class="text-lg text-gray-700 text-center">
                Somos una empresa dedicada a proporcionar los mejores servicios de remates. Con años de experiencia en el mercado, nos destacamos por nuestra profesionalidad y compromiso con nuestros clientes.
            </p>
        </div>
    </section>

    <section class="bg-gray-100 p-8 text-[rgb(59,82,138)]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-center">
            <div>
                <i class="ti ti-award mx-auto mb-4 text-6xl"></i>
                <h2 class="text-2xl font-bold">+25</h2>
                <p class="text-gray-700">Años de experiencia</p>
            </div>
            <div>
                <i class="ti ti-building mx-auto mb-4 text-6xl"></i>
                <h2 class="text-2xl font-bold">+4.000</h2>
                <p class="text-gray-700">Empresas atendidas</p>
            </div>
            <div>
                <i class="ti ti-chart-line mx-auto mb-4 text-6xl"></i>
                <h2 class="text-2xl font-bold">+50</h2>
                <p class="text-gray-700">Millones de visitas en 2023</p>
            </div>
            <div>
                <i class="ti ti-coins mx-auto mb-4 text-6xl"></i>
                <h2 class="text-2xl font-bold">+$25</h2>
                <p class="text-gray-700">Millones transaccionados en 2023</p>
            </div>
        </div>
    </section>
    
</x-home-layout>