<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pemohon') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4">

        <a href="{{ route('pemohon.index', $pendaftaran->pendaftaran_id) }}" 
           class="inline-block mb-6 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
            &larr; Kembali ke Daftar Pemohon
        </a>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('pemohon.update', [$pendaftaran->pendaftaran_id, $pemohon->pemohon_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pemohon->nama_lengkap) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $pemohon->nik) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pemohon->tanggal_lahir) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $pemohon->alamat) }}</textarea>
                        @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- No Telepon --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $pemohon->no_telepon) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('no_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- No Paspor Lama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No Paspor Lama (Opsional)</label>
                        <input type="text" name="no_paspor_lama" value="{{ old('no_paspor_lama', $pemohon->no_paspor_lama) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('no_paspor_lama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload Dokumen --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung</label>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            @php
                                $dokumenList = ['KTP','KK','Paspor_Lama','Akta_Kelahiran'];
                            @endphp
                            @foreach($dokumenList as $doc)
                                <div>
                                    <label class="block text-xs font-medium text-gray-600">{{ $doc }}</label>
                                    <input type="file" name="dokumen[{{ $doc }}]" class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1">

                                    @php
                                        $existingDoc = $pemohon->dokumens->where('jenis_dokumen', $doc)->first();
                                    @endphp
                                    @if($existingDoc)
                                        <p class="text-xs text-gray-500 mt-1">File sekarang: <a href="{{ asset('storage/'.$existingDoc->file_path) }}" target="_blank" class="underline text-blue-600">Lihat</a></p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @error('dokumen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </form>
                    <form action="{{ route('pemohon.destroy', [$pendaftaran->pendaftaran_id, $pemohon->pemohon_id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemohon ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Hapus
                        </button>
                    </form>
                </div>
        </div>
    </div>
</x-app-layout>
