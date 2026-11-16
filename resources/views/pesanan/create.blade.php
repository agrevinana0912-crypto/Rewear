@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100">
    
    <div class="mb-6 pb-4 border-b border-gray-100">
        <h1 class="text-xl font-bold text-rewear-dark">Buat Pesanan Baru</h1>
        <p class="text-xs text-gray-500 mt-0.5">Isi detail transaksi preloved dengan benar.</p>
    </div>

    <form action="{{ route('pesanan.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition" placeholder="Masukkan nama pembeli">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Pilih Produk Preloved</label>
            <select name="produk_id" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition bg-white">
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk ?? $produk->name ?? 'Produk #' . $produk->id }} - Rp {{ number_format($produk->harga ?? $produk->price ?? 0, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status Pesanan</label>
            <select name="status" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition bg-white">
                <option value="pending">Pending</option>
                <option value="proses">Diproses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-3">
            <a href="{{ route('pesanan.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Kembali</a>
            <button type="submit" class="px-5 py-2 bg-rewear-primary hover:bg-opacity-95 text-white rounded-lg text-sm font-medium shadow-sm transition">Simpan Pesanan</button>
        </div>
    </form>

</div>
@endsection