<header class="grid grid-cols-2 items-center gap-2 py-4 px-2 lg:px-32 border-b border-blue-800/20 shadow-sm w-full bg-white">
    <div class="flex justify-start">
        <a href="/">
            <img class="h-9 w-auto lg:h-14" src="{{ asset('images/TUP-REMATES-LOGO.png') }}" alt="Logo" />
        </a>
    </div>

    @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        <a href="{{ route('como-participar') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none">
            <div class="flex text-center items-center text-blue-900">
                <p class="mt-1">¿Cómo participar?</p>
            </div>
        </a>
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div class="flex text-center items-center text-blue-900">
                            <i class="ti ti-user text-3xl"></i>
                        </div>
                        @auth
                        <div class="">{{ Auth::user()->name }}</div>
                        @endauth
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @if (Auth::check())
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @else
                        <x-dropdown-link :href="route('login')">
                            {{ __('Log in') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    @endif
                    
                    @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    @endif
                </x-slot>
            </x-dropdown>
        </div>
    </nav>
    @endif
</header>