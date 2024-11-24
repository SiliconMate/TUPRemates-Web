<section class="space-y-6">
    <header class="space-y-1">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Verify Email Address') }}
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Por favor, verifica tu cuenta revisando tu correo electrónico. Si no recibiste el correo, haz clic en el botón de abajo para reenviar el correo de verificación.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div>
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </div>
    </form>
</section>