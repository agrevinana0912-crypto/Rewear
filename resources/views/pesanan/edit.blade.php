@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100">
    
    <div class="mb-6 pb-4 border-b border-gray-100">
        <h1 class="text-xl font-bold text-rewear-dark">Edit Pesanan #{{ $pesanan->id }}</h1>
        <p class="text-xs text-gray-500 mt-0.5">Perbarui status atau detail transaksi preloved.</p>
    </div>

    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" value="{{ $pesanan->nama_pembeli }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status Pesanan</label>
            <select name="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-rewear-primary transition bg-white">
                <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ $pesanan->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ $pesanan->status == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-3">
            <a href="{{ route('pesanan.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-5 py-2 bg-rewear-primary hover:bg-opacity-95 text-white rounded-lg text-sm font-medium shadow-sm transition">Simpan Perubahan</button>
        </div>
    </form>

</div>
@endsection