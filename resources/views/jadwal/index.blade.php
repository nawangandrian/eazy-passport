<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Kelola Jadwal Pelayanan</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        {{-- Card Container --}}
        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">

            <!-- Header: Search & Create Button -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <form method="GET" action="{{ route('jadwal.index') }}" class="flex flex-col sm:flex-row sm:space-x-2 w-full sm:w-auto gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Cari lokasi / PIC..."
                        class="border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none w-full sm:w-64 transition"
                    >
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition font-medium">
                        Cari
                    </button>
                </form>

                <a href="{{ route('jadwal.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md transition font-medium">
                    + Buat Jadwal Baru
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-blue-900 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-2 rounded-tl-lg">#</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Lokasi</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">PIC</th>
                            <th class="px-4 py-2">Petugas</th>
                            <th class="px-4 py-2 rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $i => $jadwal)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="px-4 py-2">{{ $jadwals->firstItem() + $i }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                <td class="px-4 py-2">{{ $jadwal->lokasi_pelayanan }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $color = match($jadwal->status_jadwal) {
                                            'Disetujui' => 'bg-green-100 text-green-800',
                                            'Ditolak' => 'bg-red-100 text-red-800',
                                            'Revisi' => 'bg-yellow-100 text-yellow-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                        {{ $jadwal->status_jadwal }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $jadwal->pendaftaran->user->nama_lengkap ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $jadwal->petugas->nama_lengkap ?? '-' }}</td>
                                <td class="px-4 py-2 flex flex-wrap gap-2">

                                    <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500 italic">
                                    Belum ada jadwal.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $jadwals->links('pagination::tailwind') }}
            </div>

        </div>

    </div>
</x-app-layout>
