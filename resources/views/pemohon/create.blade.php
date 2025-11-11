<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pemohon') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4">

        <a href="{{ route('pemohon.index', $pendaftaran->pendaftaran_id) }}" 
           class="inline-block mb-6 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
            &larr; Kembali ke Daftar Pemohon
        </a>

        <div class="bg-white shadow rounded-lg p-6">
            {{-- Tambahkan enctype multipart --}}
            <form action="{{ route('pemohon.store', $pendaftaran->pendaftaran_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('alamat') }}</textarea>
                        @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- No Telepon --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('no_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- No Paspor Lama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No Paspor Lama (Opsional)</label>
                        <input type="text" name="no_paspor_lama" value="{{ old('no_paspor_lama') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('no_paspor_lama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload Dokumen --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung</label>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            @php
                                $dokumen = ['KTP','KK','Paspor_Lama','Akta_Kelahiran'];
                            @endphp
                            @foreach($dokumen as $doc)
                                <div>
                                    <label class="block text-xs font-medium text-gray-600">{{ $doc }}</label>
                                    <input type="file" name="dokumen[{{ $doc }}]" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-1">
                                </div>
                            @endforeach
                        </div>
                        @error('dokumen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
