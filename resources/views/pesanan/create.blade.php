
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100">

    <div class="mb-6 pb-4 border-b border-gray-100">
        <h1 class="text-xl font-bold text-rewear-dark">Buat Pesanan Baru</h1>
        <p class="text-xs text-gray-500 mt-0.5">Isi detail pesanan preloved dengan benar.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Pembeli</label>
            <select name="ID_USER" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm bg-white">
                <option value="">-- Pilih Pembeli --</option>
                @foreach($users as $user)
                    <option value="{{ $user->ID_USER }}" {{ old('ID_USER') == $user->ID_USER ? 'selected' : '' }}>
                        {{ $user->NAMA }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Pilih Produk Preloved</label>
            <select name="ID_PRODUK" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm bg-white">
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->ID_PRODUK }}" {{ old('ID_PRODUK') == $produk->ID_PRODUK ? 'selected' : '' }}>
                        {{ $produk->NAMA_PRODUK }} - Rp {{ number_format($produk->HARGA, 0, ',', '.') }} (Stok: {{ $produk->STOK }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Jumlah Produk</label>
            <input type="number" name="JUMLAH" min="1" value="{{ old('JUMLAH', 1) }}" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status Pesanan</label>
            <select name="STATUS" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm bg-white">
                <option value="Diproses" {{ old('STATUS') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Dikirim" {{ old('STATUS') == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="Selesai" {{ old('STATUS') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ old('STATUS') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-3">
            <a href="{{ route('pesanan.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                Kembali
            </a>
            <button type="submit" class="px-5 py-2 bg-rewear-primary hover:bg-opacity-95 text-white rounded-lg text-sm font-medium shadow-sm transition">
                Simpan Pesanan
            </button>
        </div>
    </form>

</div>
@endsection
