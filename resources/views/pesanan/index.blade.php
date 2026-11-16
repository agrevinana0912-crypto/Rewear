@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Header & Tombol Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-rewear-dark">Kelola Pesanan</h1>
            <p class="text-sm text-gray-500">Pantau seluruh transaksi dan status pesanan preloved Anda di sini.</p>
        </div>
        <a href="{{ route('pesanan.create') }}" class="bg-rewear-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition flex items-center space-x-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Pesanan Baru</span>
        </a>
    </div>

    <!-- Statistik Ringkas (Dinamis) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Total Pesanan</p>
                <h3 class="text-xl font-bold text-rewear-dark mt-1">{{ $totalPesanan ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-rewear-light rounded-lg text-rewear-primary"><i class="fa-solid fa-bag-shopping text-lg"></i></div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Dalam Proses</p>
                <h3 class="text-xl font-bold text-amber-600 mt-1">{{ $totalProses ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-amber-50 rounded-lg text-amber-600"><i class="fa-solid fa-clock text-lg"></i></div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">Selesai</p>
                <h3 class="text-xl font-bold text-emerald-600 mt-1">{{ $totalSelesai ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600"><i class="fa-solid fa-circle-check text-lg"></i></div>
        </div>
    </div>

    <!-- Tabel Data Pesanan (Dinamis dengan @forelse) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4 font-semibold">ID Transaksi</th>
                        <th class="py-3 px-4 font-semibold">Pembeli</th>
                        <th class="py-3 px-4 font-semibold">Total Harga</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($pesanans as $pesanan)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-medium text-rewear-dark">#RW-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $pesanan->nama_pembeli }}</td>
                        <td class="py-3 px-4 font-semibold text-rewear-primary">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                {{ $pesanan->status == 'selesai' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                  ($pesanan->status == 'proses' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200') }}">
                                {{ ucfirst($pesanan->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="{{ route('pesanan.show', $pesanan->id) }}" class="text-gray-500 hover:text-rewear-primary transition" title="Lihat Detail"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="text-gray-500 hover:text-blue-600 transition" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400 text-sm">Belum ada data pesanan yang tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection