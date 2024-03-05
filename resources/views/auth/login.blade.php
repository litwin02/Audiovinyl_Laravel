<!DOCTYPE html>
<html>
    @include('partials.head')
    <body>
        @include('partials.navbar')

        <main>
            <div class="main-page">
                <div class="main-page-content">
                    <h1>Zaloguj się</h1>
                    <p>admin@admin.com hasło: admin</p>
                    <p>test@test.com hasło: 12345678</p>
                    <div class="main-page-content-login">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
        
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <br>
                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Hasło')" />
        
                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
        
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <br>
                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Zapamiętaj mnie') }}</span>
                                </label>
                            </div>
                            <br>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Zapomniałeś hasła?') }}
                                    </a>
                                @endif
        
                                <x-primary-button class="ms-3">
                                    {{ __('Zaloguj się') }}
                                </x-primary-button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        
        @include('partials.footer')
    </body>
</html>