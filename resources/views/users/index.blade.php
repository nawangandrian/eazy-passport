<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Container Card --}}
        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">

            {{-- ✅ Header Search + Tambah --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-3">
                <form action="{{ route('users.index') }}" method="GET"
                    class="flex flex-col sm:flex-row items-center sm:space-x-2 gap-2 w-full sm:w-auto">
                    <input type="text" name="search" placeholder="Cari nama / email..." 
                        value="{{ request('search') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64 transition">
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg shadow-md transition font-medium w-full sm:w-auto">
                        Cari
                    </button>
                </form>

                <a href="{{ route('users.create') }}" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md transition font-medium text-center">
                    + Tambah User
                </a>
            </div>

            {{-- ✅ Tabel untuk layar sedang - besar --}}
            <div class="hidden sm:block overflow-x-auto rounded-lg border border-gray-100 shadow-sm">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-blue-900 text-white uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 rounded-tl-lg">#</th>
                            <th class="px-6 py-3">Username</th>
                            <th class="px-6 py-3">Nama Lengkap</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">No Telepon</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 rounded-tr-lg text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-3">{{ $users->firstItem() + $index }}</td>
                                <td class="px-6 py-3 font-medium text-gray-800">{{ $user->username }}</td>
                                <td class="px-6 py-3">{{ $user->nama_lengkap }}</td>
                                <td class="px-6 py-3">{{ $user->email }}</td>
                                <td class="px-6 py-3">{{ $user->no_telepon ?? '-' }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($user->role == 'PIC') bg-blue-100 text-blue-700
                                        @elseif($user->role == 'PETUGAS') bg-yellow-100 text-yellow-700
                                        @else bg-purple-100 text-purple-700 @endif">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        {{ $user->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 flex justify-center space-x-2">
                                    <a href="{{ route('users.edit', $user) }}" 
                                        class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>

                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-6 text-center text-gray-500 italic">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ Tampilan versi mobile (Card View) --}}
            <div class="block sm:hidden space-y-4">
                @forelse ($users as $index => $user)
                    <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-base font-bold text-gray-800">{{ $user->nama_lengkap }}</h3>
                            <span class="text-xs font-semibold px-2 py-1 rounded 
                                {{ $user->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $user->status }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="text-sm text-gray-600 mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="text-sm text-gray-600 mb-1"><strong>Telepon:</strong> {{ $user->no_telepon ?? '-' }}</p>
                        <p class="text-sm text-gray-600 mb-3">
                            <strong>Role:</strong>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($user->role == 'PIC') bg-blue-100 text-blue-700
                                @elseif($user->role == 'PETUGAS') bg-yellow-100 text-yellow-700
                                @else bg-purple-100 text-purple-700 @endif">
                                {{ $user->role }}
                            </span>
                        </p>

                        <div class="flex gap-2">
                            <a href="{{ route('users.edit', $user) }}" 
                               class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-semibold transition">
                                Edit
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-sm font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 italic">Belum ada data user.</p>
                @endforelse
            </div>

            {{-- ✅ Pagination --}}
            <div class="mt-6">
                {{ $users->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
