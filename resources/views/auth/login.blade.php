<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-white">
        <div class="bg-white shadow-2xl rounded-2xl max-w-md w-full p-8">

            <!-- Logo / Judul -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-30 h-20">
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Selamat Datang</h2>
            <p class="text-center text-gray-500 mb-6">Masuk ke akun Eazy Passport Anda</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input 
                        id="email" 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input 
                        id="password" 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Remember Me 
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 text-gray-600 text-sm">Ingat saya</label>
                </div> -->

                <!-- Submit Button -->
                <div class="mb-4">
                    <x-primary-button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300 flex justify-center items-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('home') }}" 
                    class="inline-flex items-center text-gray-600 hover:text-blue-700 transition font-medium">
                        <!-- Icon Back -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>

                        <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-blue-700 transition">
                            Belum punya akun?
                        </a>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
