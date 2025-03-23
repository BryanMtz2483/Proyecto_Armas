<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label class="text-xl" for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label class="text-xl" for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="text-xl"for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-base  text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4 space-x-2">
                @if (Route::has('password.request'))
                    <a class="text-base rounded-md px-3 py-2 w-40 h-16 border-white text-black ring-1 ring-transparent transition border  hover:bg-blue-500 hover:text-white text-center" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button class="text-lg lg:justify-center rounded-md px-3 py-2 w-40 h-16 border-white text-black ring-1 ring-transparent transition border  hover:bg-blue-500 hover:text-white">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
