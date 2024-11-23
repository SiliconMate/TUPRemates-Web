<header class="grid grid-cols-2 items-center gap-2 py-4 px-2 lg:px-32 border-b border-black/10 dark:border-white/10 shadow-sm w-full bg-white dark:bg-gray-800">
    <div class="flex justify-start">
        <a href="/">
            <img class="h-9 w-auto lg:h-14" src="{{ asset('images/TUP-REMATES-LOGO.png') }}" alt="Logo" />
        </a>
    </div>

    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            {{-- <x-home.theme-toggle-button /> --}}
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    <i class="ti ti-user text-3xl text-blue-900"></i>
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>