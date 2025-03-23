<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-black">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block text-black text-lg">
                <label class="text-black text-base" for="email" value="{{ __('Email') }}">Email</label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="text-lg lg:justify-center rounded-md px-3 py-2 w-100 h-12 border-white text-black ring-1 ring-transparent transition border  hover:bg-blue-500 hover:text-white">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
