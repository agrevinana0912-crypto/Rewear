@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">

    <div class="flex justify-between items-start pb-4 border-b border-gray-100">
        <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-rewear-secondary">Detail Pesanan</span>
            <h1 class="text-2xl font-bold text-rewear-dark mt-1">
                #RW-{{ str_pad($pesanan->ID_PESANAN, 4, '0', STR_PAD_LEFT) }}
            </h1>
        </div>
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-rewear-light text-rewear-primary border border-rewear-accent">
            {{ $pesanan->STATUS }}
        </span>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p class="text-xs text-gray-400">Nama Pembeli</p>
            <p class="font-semibold text-rewear-dark mt-1">
                {{ $pesanan->userRewear->NAMA ?? '-' }}
            </p>
        </div>
        <div>
            <p class="text-xs text-gray-400">Tanggal Pesanan</p>
            <p class="font-semibold text-rewear-dark mt-1">
                {{ $pesanan->TANGGAL ?? '-' }}
            </p>
        </div>
    </div>

    <div class="border-t border-b border-gray-100 py-4">
        <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Item Preloved</p>

        <div class="space-y-3 text-sm">
            @forelse($pesanan->detailPesanan as $item)
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-700">
                            {{ $item->produk->NAMA_PRODUK ?? 'Produk tidak ditemukan' }}
                        </p>
                        <p class="text-gray-400">
                            Jumlah: {{ $item->JUMLAH }}
                        </p>
                    </div>
                    <span class="font-medium text-rewear-dark">
                        Rp {{ number_format(($item->produk->HARGA ?? 0) * $item->JUMLAH, 0, ',', '.') }}
                    </span>
                </div>
            @empty
                <p class="text-gray-400">Belum ada detail produk.</p>
            @endforelse
        </div>
    </div>

    <div class="flex justify-between items-center pt-1">
        <span class="text-sm font-semibold text-gray-600">Total Pembayaran</span>
        <span class="text-xl font-bold text-rewear-primary">
            Rp {{ number_format($pesanan->TOTAL_HARGA ?? 0, 0, ',', '.') }}
        </span>
    </div>

    <div class="pt-4 flex justify-end">
        <a href="{{ route('pesanan.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-arrow-left mr-1.5"></i>
            Kembali ke Daftar
        </a>
    </div>

</div>
@endsection
