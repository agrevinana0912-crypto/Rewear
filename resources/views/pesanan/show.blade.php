@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
    
    <div class="flex justify-between items-start pb-4 border-b border-gray-100">
        <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-rewear-secondary">Detail Transaksi</span>
            <h1 class="text-2xl font-bold text-rewear-dark mt-0.5">#RW-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</h1>
        </div>
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-rewear-light text-rewear-primary border border-rewear-accent capitalize">
            {{ $pesanan->status }}
        </span>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p class="text-xs text-gray-400">Nama Pembeli</p>
            <p class="font-semibold text-rewear-dark mt-0.5">{{ $pesanan->nama_pembeli }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400">Tanggal Pesanan</p>
            <p class="font-semibold text-rewear-dark mt-0.5">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <!-- Rincian Produk -->
    <div class="border-t border-b border-gray-100 py-4">
        <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Item Preloved</p>
        <div class="space-y-2 text-sm">
            @foreach($pesanan->items as $item)
            <div class="flex justify-between items-center">
                <span class="text-gray-700">{{ $item->produk->nama_produk ?? 'Produk Preloved' }} <span class="text-gray-400">x{{ $item->qty }}</span></span>
                <span class="font-medium text-rewear-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-between items-center pt-1">
        <span class="text-sm font-semibold text-gray-600">Total Pembayaran</span>
        <span class="text-xl font-bold text-rewear-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
    </div>

    <div class="pt-4 flex justify-end">
        <a href="{{ route('pesanan.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
            <i class="fa-solid fa-arrow-left mr-1.5"></i> Kembali ke Daftar
        </a>
    </div>

</div>
@endsection