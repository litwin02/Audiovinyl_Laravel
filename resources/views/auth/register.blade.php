<!DOCTYPE html>
<html>
    @include('partials.head')
    <body>
        @include('partials.navbar')

        <main>
            <div class="main-page">
                <div class="main-page-content">
                    <h1>Zarejestruj się</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
    
                        <!-- First name -->
                        <div>
                            <x-input-label for="firstName" :value="__('Imię')" />
                            <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" />
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                        </div>
                        <br>
                        <!-- Last name -->
                        <div class="mt-4">
                            <x-input-label for="lastName" :value="__('Nazwisko')" />
                            <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                        </div>
                        <br>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <br>
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Hasło')" />
    
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
    
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <br>
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Potwierdź hasło')" />
    
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
    
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <br>
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                {{ __('Zarejestrowany już?') }}
                            </a>
    
                            <x-primary-button class="ms-4">
                                {{ __('Zarejestruj') }}
                            </x-primary-button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </body>
</html>
