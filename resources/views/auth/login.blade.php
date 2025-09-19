<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-black">
        <!-- Logo -->
        <div class="mb-6">
            <img src="https://sunrisedigital.co.in/assets/images/logo/Sunrise-logo-New.png"
                 alt="Sunrise Digital Logo"
                 class="h-16 w-auto">
        </div>

        <!-- Form Card -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-gray-900 shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white"/>
                    <x-text-input id="email"
                                  class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white"/>
                    <x-text-input id="password"
                                  class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-600 bg-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

