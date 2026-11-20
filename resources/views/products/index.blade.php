@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Header & Tombol Tambah Produk -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-rewear-dark">Produk Preloved Saya</h1>
            <p class="text-sm text-gray-500">Kelola daftar pakaian dan barang preloved yang kamu jual di ReWear.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-rewear-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition flex items-center space-x-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Produk Baru</span>
        </a>
    </div>

    <!-- Statistik Ringkas Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Total Produk</p>
                <h3 class="text-xl font-bold text-rewear-dark mt-1">{{ $totalProduk ?? $products->count() }}</h3>
            </div>
            <div class="p-3 bg-rewear-light rounded-lg text-rewear-primary">
                <i class="fa-solid fa-shirt text-lg"></i>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Total Stok Barang</p>
<h3 class="text-xl font-bold text-emerald-600 mt-1">{{ $totalStok }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                <i class="fa-solid fa-boxes-stacked text-lg"></i>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Total Kategori</p>
                <h3 class="text-xl font-bold text-rewear-secondary mt-1">{{ $totalKategori ?? $products->pluck('kategori')->filter()->unique()->count() }}</h3>
            </div>
            <div class="p-3 bg-stone-100 rounded-lg text-stone-600">
                <i class="fa-solid fa-tags text-lg"></i>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Produk -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4 font-semibold text-center w-12">No</th>
                        <th class="py-3 px-4 font-semibold">Foto</th>
                        <th class="py-3 px-4 font-semibold">Nama Produk</th>
                        <th class="py-3 px-4 font-semibold">Kategori</th>
                        <th class="py-3 px-4 font-semibold">Harga</th>
                        <th class="py-3 px-4 font-semibold">Ukuran</th>
                        <th class="py-3 px-4 font-semibold">Kondisi</th>
                        <th class="py-3 px-4 font-semibold text-center">Stok</th>
                        <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 text-center text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-3 px-4">
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-12 h-12 rounded-lg object-cover border border-gray-100 shadow-xs">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 text-xs font-medium">
                                    <i class="fa-solid fa-image text-gray-400 text-base"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-rewear-dark">
                            <a href="{{ route('products.show', $product->id) }}" class="hover:text-rewear-primary transition">
                                {{ $product->nama_produk }}
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-stone-100 text-stone-700">
                                {{ $product->kategori }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-semibold text-rewear-primary">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-gray-600 font-medium">
                            {{ $product->ukuran ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                {{ $product->kondisi == 'Baru' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                  ($product->kondisi == 'Sangat Baik' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200') }}">
                                {{ $product->kondisi }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $product->stok > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $product->stok }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-2 whitespace-nowrap">
                            <a href="{{ route('products.show', $product->id) }}" class="text-gray-500 hover:text-rewear-primary transition" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-gray-500 hover:text-blue-600 transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk {{ addslashes($product->nama_produk) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center text-gray-300">
                                    <i class="fa-solid fa-shirt text-2xl"></i>
                                </div>
                                <div class="text-center">
                                    <p class="text-base font-semibold text-gray-700">Belum Ada Produk Preloved</p>
                                    <p class="text-xs text-gray-400 mt-1">Yuk, mulai tambahkan barang preloved pertamamu ke katalog!</p>
                                </div>
                                <a href="{{ route('products.create') }}" class="mt-2 px-4 py-2 bg-rewear-primary text-white rounded-lg text-xs font-medium hover:bg-opacity-95 transition">
                                    <i class="fa-solid fa-plus mr-1"></i> Tambah Produk Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
