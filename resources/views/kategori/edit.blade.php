
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="{{ route('kategori.index') }}"
           class="text-sm text-gray-500 hover:text-rewear-primary">
            <i class="fa-solid fa-arrow-left mr-1"></i>
            Kembali ke Kategori
        </a>

        <h1 class="text-2xl font-bold text-rewear-dark mt-4">
            Edit Kategori
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi kategori produk ReWear.
        </p>
    </div>


    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        <form action="{{ route('kategori.update', $kategori->id) }}"
              method="POST"
              class="space-y-5">

            @csrf
            @method('PUT')


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori
                </label>

                <input type="text"
                       name="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       placeholder="Contoh: Atasan"
                       required
                       maxlength="100"
                       class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-rewear-secondary">

                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Kategori
                </label>

                <textarea name="deskripsi"
                          rows="5"
                          placeholder="Masukkan deskripsi kategori..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-rewear-secondary">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-3 border-t border-gray-100">

                <a href="{{ route('kategori.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-600 text-sm font-medium text-center hover:bg-gray-50">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-rewear-primary text-white text-sm font-medium hover:bg-opacity-90">

                    <i class="fa-solid fa-save mr-1"></i>
                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
