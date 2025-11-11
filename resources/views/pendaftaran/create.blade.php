<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-blue-800 mb-6">Formulir Pendaftaran Baru</h1>

        <form action="{{ route('pendaftaran.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700">Lokasi Layanan</label>
                <input type="text" name="lokasi_layanan" class="w-full border-gray-300 rounded-lg shadow-sm mt-1" placeholder="Contoh: Kantor Imigrasi Pati" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700">Jenis Layanan</label>
                    <select name="jenis_layanan" class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                        <option value="Baru atau Penggantian">Baru atau Penggantian</option>
                        <option value="Reguler atau Percepatan">Reguler atau Percepatan</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-end">
                <a href="{{ route('pendaftaran.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition mr-2">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg shadow-md transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
