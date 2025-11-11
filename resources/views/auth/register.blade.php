<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-white">
        <div class="bg-white shadow-2xl rounded-2xl max-w-4xl w-full p-10 space-y-6">
            
            <!-- Logo & Judul -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-30 h-20">
                <h2 class="text-3xl font-bold text-blue-700">Daftar Akun Baru</h2>
                <p class="text-gray-500 text-sm">Isi semua data untuk membuat akun</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                <!-- Username -->
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="text" name="username" :value="old('username')" required autofocus />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                    <x-text-input id="nama_lengkap" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required />
                    <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- No Telepon -->
                <div>
                    <x-input-label for="no_telepon" :value="__('No Telepon')" />
                    <x-text-input id="no_telepon" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="text" name="no_telepon" :value="old('no_telepon')" />
                    <x-input-error :messages="$errors->get('no_telepon')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role (hidden default PIC) -->
                <input type="hidden" name="role" value="PIC">

                <!-- Tombol & Link (full width di bawah grid) -->
                <div class="md:col-span-2 flex items-center justify-between mt-6">
                    <a class="text-sm text-gray-600 hover:text-blue-700 transition underline" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="bg-blue-700 hover:bg-blue-800 px-8 py-3 rounded-lg font-semibold text-lg">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
