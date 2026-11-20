```blade
@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <a href="{{ route('kategori.index') }}"
       class="text-sm text-gray-500 hover:text-gray-800">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali ke Kategori
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Detail Kategori
        </h1>

        <p class="text-gray-500 mb-6">
            Informasi lengkap kategori produk ReWear.
        </p>

        <div class="space-y-5">

            <div>
                <label class="block text-sm text-gray-500 mb-1">
                    ID Kategori
                </label>
                <p class="font-semibold text-gray-800">
                    {{ $kategori->id }}
                </p>
            </div>

            <div>
                <label class="block text-sm text-gray-500 mb-1">
                    Nama Kategori
                </label>
                <p class="font-semibold text-gray-800">
                    {{ $kategori->nama_kategori }}
                </p>
            </div>

            <div>
                <label class="block text-sm text-gray-500 mb-1">
                    Deskripsi
                </label>
                <p class="text-gray-700">
                    {{ $kategori->deskripsi ?: 'Tidak ada deskripsi.' }}
                </p>
            </div>

            <div>
                <label class="block text-sm text-gray-500 mb-1">
                    Dibuat Pada
                </label>
                <p class="text-gray-700">
                    {{ $kategori->created_at?->format('d M Y, H:i') ?? '-' }}
                </p>
            </div>

        </div>

        <div class="flex gap-3 mt-8">
            <a href="{{ route('kategori.edit', $kategori->id) }}"
               class="bg-[#4A5D4E] text-white px-5 py-2 rounded-lg hover:bg-[#2C352D]">
                <i class="fa-solid fa-pen mr-2"></i>
                Edit Kategori
            </a>

            <a href="{{ route('kategori.index') }}"
               class="border border-gray-300 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-50">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
