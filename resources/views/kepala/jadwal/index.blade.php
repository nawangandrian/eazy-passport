<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tinjau Rencana Jadwal') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded p-6">
            <!-- 🔍 Filter Form -->
            <div class="mb-4">
                <form method="GET" action="{{ route('kepala.jadwal.index') }}" 
                    class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-3 w-full bg-gray-50 p-4 rounded-lg border border-gray-200">

                    {{-- Filter Status --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                        <label for="status" class="font-semibold text-sm sm:mr-1">Status:</label>
                        <select name="status" id="status" 
                                class="border px-3 py-2 rounded w-full sm:w-48 focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">Semua</option>
                            <option value="Menunggu Persetujuan" {{ ($status ?? '') == 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                            <option value="Disetujui" {{ ($status ?? '') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ ($status ?? '') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Revisi" {{ ($status ?? '') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                        </select>
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                        <label for="tanggal_mulai" class="font-semibold text-sm sm:mr-1">Dari:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                            class="border px-3 py-2 rounded w-full sm:w-40 focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ $tanggalMulai ?? '' }}">
                    </div>

                    {{-- Tanggal Akhir --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                        <label for="tanggal_akhir" class="font-semibold text-sm sm:mr-1">Sampai:</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" 
                            class="border px-3 py-2 rounded w-full sm:w-40 focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ $tanggalAkhir ?? '' }}">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto mt-1 sm:mt-0">
                        <button type="submit" 
                                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 text-sm font-medium transition">
                            Terapkan
                        </button>

                        @if($status || $tanggalMulai || $tanggalAkhir)
                            <a href="{{ route('kepala.jadwal.index') }}" 
                            class="w-full sm:w-auto text-gray-700 underline text-sm font-medium text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

            <!-- Wrapper -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <!-- Table (desktop) / Card (mobile) -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border hidden sm:table">
                        <thead class="bg-blue-900 text-white uppercase text-xs">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">PIC / Pemohon</th>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Waktu</th>
                                <th class="px-4 py-2">Lokasi</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Catatan</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwals as $i => $jadwal)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $jadwals->firstItem() + $i }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->pendaftaran->user->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->lokasi_pelayanan }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $color = match($jadwal->status_jadwal) {
                                                'Disetujui' => 'text-green-600',
                                                'Ditolak' => 'text-red-600',
                                                'Revisi' => 'text-yellow-600',
                                                default => 'text-gray-600',
                                            };
                                        @endphp
                                        <span class="font-semibold {{ $color }}">{{ $jadwal->status_jadwal }}</span>
                                    </td>
                                    <td class="px-4 py-2">{{ $jadwal->catatan_kepala ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('kepala.jadwal.updateStatus', $jadwal->jadwal_id) }}" method="POST" class="space-y-1">
                                            @csrf
                                            <select name="status_jadwal" class="border px-2 py-1 w-full text-sm rounded">
                                                <option value="" disabled selected>Pilih Aksi</option>
                                                <option value="Disetujui">Setujui</option>
                                                <option value="Ditolak">Tolak</option>
                                                <option value="Revisi">Revisi</option>
                                            </select>
                                            <input type="text" name="catatan_kepala" placeholder="Catatan (opsional)" class="border px-2 py-1 w-full text-sm mt-1 rounded">
                                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded w-full text-xs mt-1 hover:bg-blue-700 transition">
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3 text-gray-500">Belum ada rencana jadwal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Card view (mobile) -->
                    <div class="sm:hidden space-y-4">
                        @forelse($jadwals as $i => $jadwal)
                            <div class="border rounded-lg p-4 shadow-sm bg-white">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="font-semibold text-gray-800 text-base">
                                        {{ $jadwal->pendaftaran->user->nama_lengkap ?? '-' }}
                                    </h3>
                                    <span class="text-xs text-gray-500">#{{ $jadwals->firstItem() + $i }}</span>
                                </div>

                                <p class="text-sm text-gray-600"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d-m-Y') }}</p>
                                <p class="text-sm text-gray-600"><strong>Waktu:</strong> {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                                <p class="text-sm text-gray-600"><strong>Lokasi:</strong> {{ $jadwal->lokasi_pelayanan }}</p>

                                @php
                                    $color = match($jadwal->status_jadwal) {
                                        'Disetujui' => 'text-green-600',
                                        'Ditolak' => 'text-red-600',
                                        'Revisi' => 'text-yellow-600',
                                        default => 'text-gray-600',
                                    };
                                @endphp
                                <p class="text-sm"><strong>Status:</strong> <span class="font-semibold {{ $color }}">{{ $jadwal->status_jadwal }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Catatan:</strong> {{ $jadwal->catatan_kepala ?? '-' }}</p>

                                <form action="{{ route('kepala.jadwal.updateStatus', $jadwal->jadwal_id) }}" method="POST" class="mt-3 space-y-2">
                                    @csrf
                                    <select name="status_jadwal" class="border px-2 py-1 w-full text-sm rounded">
                                        <option value="" disabled selected>Pilih Aksi</option>
                                        <option value="Disetujui">Setujui</option>
                                        <option value="Ditolak">Tolak</option>
                                        <option value="Revisi">Revisi</option>
                                    </select>
                                    <input type="text" name="catatan_kepala" placeholder="Catatan (opsional)" class="border px-2 py-1 w-full text-sm rounded">
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded w-full text-xs hover:bg-blue-700 transition">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 italic py-4">Belum ada rencana jadwal.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">{{ $jadwals->links() }}</div>
        </div>

    </div>
</x-app-layout>
