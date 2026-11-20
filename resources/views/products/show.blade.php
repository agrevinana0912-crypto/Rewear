@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
    
    <!-- Top Bar Navigation -->
    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-2">
            <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:text-rewear-primary transition flex items-center">
                <i class="fa-solid fa-arrow-left mr-1.5"></i> Kembali ke Daftar Produk
            </a>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-xs font-medium transition flex items-center space-x-1">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Edit Produk</span>
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-medium transition flex items-center space-x-1">
                    <i class="fa-solid fa-trash"></i>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Product Detail Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        
        <!-- Foto Produk -->
        <div>
            @if($product->foto)
                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-full h-80 object-cover rounded-xl border border-gray-100 shadow-sm">
            @else
                <div class="w-full h-80 bg-gray-50 border border-dashed border-gray-200 rounded-xl flex flex-col items-center justify-center text-gray-400">
                    <i class="fa-solid fa-image text-4xl mb-2 text-gray-300"></i>
                    <span class="text-xs">Foto tidak tersedia</span>
                </div>
            @endif
        </div>

        <!-- Detail Informasi -->
        <div class="space-y-4">
            <div>
                <div class="flex items-center space-x-2 mb-2">
                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-stone-100 text-stone-700">
                        {{ $product->kategori }}
                    </span>
                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full 
                        {{ $product->kondisi == 'Baru' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                          ($product->kondisi == 'Sangat Baik' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200') }}">
                        Kondisi: {{ $product->kondisi }}
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-rewear-dark">{{ $product->nama_produk }}</h1>
                <p class="text-2xl font-bold text-rewear-primary mt-2">
                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 py-3 border-y border-gray-100 text-xs">
                <div>
                    <span class="text-gray-400 block mb-0.5">Ukuran / Size</span>
                    <span class="font-semibold text-rewear-dark text-sm">{{ $product->ukuran ?: '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Ketersediaan Stok</span>
                    <span class="font-semibold {{ $product->stok > 0 ? 'text-emerald-600' : 'text-red-600' }} text-sm">
                        {{ $product->stok }} unit
                    </span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Penjual / Seller</span>
                    <span class="font-semibold text-rewear-dark text-sm">{{ $product->user->name ?? 'Nana (Seller ReWear)' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Ditambahkan Pada</span>
                    <span class="font-semibold text-rewear-dark text-sm">{{ $product->created_at ? $product->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>

            <!-- Deskripsi Produk -->
            <div>
                <h3 class="text-xs font-semibold uppercase text-gray-500 mb-1.5">Deskripsi Produk</h3>
                <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line bg-gray-50/70 p-4 rounded-lg border border-gray-100">
                    {{ $product->deskripsi ?: 'Tidak ada deskripsi untuk produk preloved ini.' }}
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
