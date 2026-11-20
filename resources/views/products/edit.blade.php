@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100">
    
    <div class="mb-6 pb-4 border-b border-gray-100">
        <h1 class="text-xl font-bold text-rewear-dark">Edit Produk Preloved</h1>
        <p class="text-xs text-gray-500 mt-0.5">Perbarui rincian pakaian atau barang preloved kamu.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-xs space-y-1">
            <div class="font-semibold flex items-center space-x-1.5 mb-1">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Terdapat kesalahan pada input:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Produk <span class="text-red-500">*</span></label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">
        </div>

        <!-- Kategori & Kondisi -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition bg-white">
                    @foreach(['Baju', 'Celana', 'Tas', 'Sepatu', 'Aksesoris'] as $kat)
                        <option value="{{ $kat }}" {{ old('kategori', $product->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kondisi Barang <span class="text-red-500">*</span></label>
                <select name="kondisi" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition bg-white">
                    @foreach(['Baru', 'Sangat Baik', 'Baik'] as $kon)
                        <option value="{{ $kon }}" {{ old('kondisi', $product->kondisi) == $kon ? 'selected' : '' }}>{{ $kon }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Harga & Ukuran -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', (int)$product->harga) }}" min="0" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Ukuran / Size</label>
                <input type="text" name="ukuran" value="{{ old('ukuran', $product->ukuran) }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">
            </div>
        </div>

        <!-- Stok & Foto -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Jumlah Stok <span class="text-red-500">*</span></label>
                <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" min="0" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Foto Produk Baru</label>
                <input type="file" name="foto" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-rewear-light file:text-rewear-primary hover:file:bg-rewear-accent/40 cursor-pointer">
                <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
            </div>
        </div>

        <!-- Preview Foto Saat Ini -->
        @if ($product->foto)
            <div class="p-3 bg-gray-50 border border-gray-100 rounded-lg flex items-center space-x-3">
                <img src="{{ asset('storage/' . $product->foto) }}" alt="Foto saat ini" class="w-14 h-14 rounded-lg object-cover border border-gray-200">
                <div class="text-xs text-gray-500">
                    <p class="font-medium text-gray-700">Foto saat ini</p>
                    <p class="text-[11px] text-gray-400">File tersimpan di sistem.</p>
                </div>
            </div>
        @endif

        <!-- Deskripsi Produk -->
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Deskripsi Produk</label>
            <textarea name="deskripsi" rows="3" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-4 flex items-center justify-end space-x-3">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-rewear-primary hover:bg-opacity-95 text-white rounded-lg text-sm font-medium shadow-sm transition flex items-center space-x-1.5">
                <i class="fa-solid fa-check"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection
