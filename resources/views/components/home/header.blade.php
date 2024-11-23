<header class="grid grid-cols-2 items-center gap-2 py-4 px-2 lg:px-32 border-b border-blue-800/20 shadow-sm w-full bg-white">
    <div class="flex justify-start">
        <a href="/">
            <img class="h-9 w-auto lg:h-14" src="{{ asset('images/TUP-REMATES-LOGO.png') }}" alt="Logo" />
        </a>
    </div>

    @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        {{-- <x-home.theme-toggle-button /> --}}
        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none">
            <div class="flex text-center items-center text-blue-900">
                <i class="ti ti-user text-3xl"></i>
                <p class="mt-1">Cuenta</p>
            </div>
        </a>
    </nav>
    @endif
</header>