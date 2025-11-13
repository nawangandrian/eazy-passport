<nav x-data="{ open: false }" class="bg-blue-900 border-b border-blue-800 text-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo di kiri -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-22 h-16">
                </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden sm:flex sm:space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-blue-300">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @if(auth()->user()->role !== 'KEPALA_KANTOR')
                    <x-nav-link :href="route('pendaftaran.index')" :active="request()->routeIs('pendaftaran.*')" class="text-white hover:text-blue-300">
                        {{ __('Pendaftaran') }}
                    </x-nav-link>
                @endif
                @if(Auth::user()->role === 'PIC')
                    <x-nav-link :href="route('jadwal.saya')" :active="request()->routeIs('jadwal.saya*')" class="text-white hover:text-blue-300">
                        Jadwal Saya
                    </x-nav-link>
                @endif
                @if(Auth::user()->role === 'PETUGAS')
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="text-white hover:text-blue-300">
                        Manajemen Pengguna
                    </x-nav-link>
                    <x-nav-link :href="route('jadwal.index')" :active="request()->routeIs('jadwal.*')" class="text-white hover:text-blue-300">
                        Kelola Jadwal Pelayanan
                    </x-nav-link>
                    <x-nav-link :href="route('surat.index')" :active="request()->routeIs('surat.*')" class="text-white hover:text-blue-300">
                        Surat Pemberitahuan
                    </x-nav-link>
                @elseif(Auth::user()->role === 'KEPALA_KANTOR')
                    <x-nav-link :href="route('kepala.jadwal.index')" :active="request()->routeIs('kepala.jadwal.*')" class="text-white hover:text-blue-300">
                        Tinjau Rencana Jadwal
                    </x-nav-link>
                    <x-nav-link :href="route('surat.index')" :active="request()->routeIs('surat.*')" class="text-white hover:text-blue-300">
                        Surat Pemberitahuan
                    </x-nav-link>
                @endif
            </div>
            </div>


            <!-- Desktop Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 focus:outline-none transition">
                            <div>{{ Auth::user()->nama_lengkap ?? Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Title di kanan -->
            <div class="sm:hidden text-lg font-semibold">
                Eazy Passport
            </div>
        </div>
    </div>

    <!-- Mobile Floating Profile Icon tetap sama -->
    <div x-data="{ openSettings: false }" class="sm:hidden fixed bottom-20 right-4 z-50">
        <button @click="openSettings = !openSettings" 
                class="bg-blue-800 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 border-2 border-white focus:outline-none">
            <!-- Icon Setting (Gear) -->
            <svg 
                :class="{'animate-spin': openSettings}" 
                class="h-6 w-6 transition-transform duration-500" 
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.285 1.15 1.724 1.724 0 011.151 2.286c.922.3.922 1.603 0 1.902a1.724 1.724 0 00-1.15 2.285 1.724 1.724 0 01-2.286 1.151c-.3.922-1.603.922-1.902 0a1.724 1.724 0 00-2.285-1.15 1.724 1.724 0 01-1.151-2.286c-.922-.3-.922-1.603 0-1.902a1.724 1.724 0 001.15-2.285 1.724 1.724 0 012.286-1.151zM12 15a3 3 0 100-6 3 3 0 000 6z"/>
            </svg>
        </button>

        <div x-show="openSettings" x-transition class="mt-2 w-56 bg-white text-gray-800 rounded-lg shadow-lg border-2 border-blue-900 ring-1 ring-black ring-opacity-5">
            <div class="p-4 border-b border-gray-200 flex items-center">
                <img src="{{ asset('img/logo-tpi.png') }}" alt="Logo" class="h-8 w-8 rounded-full mr-3">
                <div>
                    <div class="font-medium text-base">{{ Auth::user()->nama_lengkap ?? Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="flex flex-col divide-y divide-gray-200">
                <x-responsive-nav-link :href="route('profile.edit')" class="px-4 py-2 hover:bg-blue-100">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="px-4 py-2 hover:bg-blue-100">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>


<!-- Mobile Bottom Navbar -->
<nav class="fixed bottom-0 left-0 w-full bg-blue-900 sm:hidden shadow-inner z-50">
    <div class="flex justify-around text-white">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('dashboard') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            <span class="text-xs">Dashboard</span>
        </a>

        <!-- Pendaftaran -->
        @if(auth()->user()->role !== 'KEPALA_KANTOR')
        <a href="{{ route('pendaftaran.index') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('pendaftaran.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-xs">Pendaftaran</span>
        </a>
        @endif

        <!-- Jadwal Saya (PIC) -->
        @if(Auth::user()->role === 'PIC')
        <a href="{{ route('jadwal.saya') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('jadwal.saya*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7H3v10a2 2 0 002 2z" />
            </svg>
            <span class="text-xs">Jadwal</span>
        </a>
        @endif

        <!-- Manajemen Pengguna (PETUGAS) -->
        @if(Auth::user()->role === 'PETUGAS')
        <a href="{{ route('users.index') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('users.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A5 5 0 0112 15a5 5 0 016.879 2.804M15 11a4 4 0 10-6 0 4 4 0 006 0z" />
            </svg>
            <span class="text-xs">Users</span>
        </a>

        <!-- Kelola Jadwal Pelayanan -->
        <a href="{{ route('jadwal.index') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('jadwal.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7H3v10a2 2 0 002 2z" />
            </svg>
            <span class="text-xs">Jadwal</span>
        </a>
        @endif

        <!-- Tinjau Rencana Jadwal (KEPALA_KANTOR) -->
        @if(Auth::user()->role === 'KEPALA_KANTOR')
        <a href="{{ route('kepala.jadwal.index') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('kepala.jadwal.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            <span class="text-xs">Jadwal</span>
        </a>
        @endif

        <!-- Surat Pemberitahuan (PETUGAS & KEPALA_KANTOR) -->
        @if(Auth::user()->role === 'PETUGAS' || Auth::user()->role === 'KEPALA_KANTOR')
        <a href="{{ route('surat.index') }}" class="flex flex-col items-center py-2 w-full text-center rounded-lg transition
            {{ request()->routeIs('surat.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m0 0v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8m18 0L12 15 3 8" />
            </svg>
            <span class="text-xs">Surat</span>
        </a>
        @endif
    </div>
</nav>
