
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-rewear-dark">Kelola Pesanan</h1>
            <p class="text-sm text-gray-500">Pantau seluruh transaksi dan status pesanan preloved Anda di sini.</p>
        </div>
        <a href="{{ route('pesanan.create') }}" class="bg-rewear-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
            <i class="fa-solid fa-plus"></i>
            Tambah Pesanan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-50 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500 font-medium uppercase">Total Pesanan</p>
            <h3 class="text-xl font-bold text-rewear-dark mt-1">{{ $totalPesanan }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500 font-medium uppercase">Dalam Proses</p>
            <h3 class="text-xl font-bold text-amber-600 mt-1">{{ $totalProses }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500 font-medium uppercase">Selesai</p>
            <h3 class="text-xl font-bold text-emerald-600 mt-1">{{ $totalSelesai }}</h3>
        </div>
    </div>

    <!-- Tabel Data Pesanan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                        <th class="py-3 px-4">ID Pesanan</th>
                        <th class="py-3 px-4">Pembeli</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Total Harga</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($pesanans as $pesanan)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-rewear-dark">
                            #RW-{{ str_pad($pesanan->ID_PESANAN, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ $pesanan->userRewear->NAMA ?? 'Pengguna tidak ditemukan' }}
                        </td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ $pesanan->TANGGAL ?? '-' }}
                        </td>
                        <td class="py-3 px-4 font-semibold text-rewear-primary">
                            Rp {{ number_format($pesanan->TOTAL_HARGA ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                {{ $pesanan->STATUS == 'Selesai' ? 'bg-emerald-50 text-emerald-700' :
                                ($pesanan->STATUS == 'Diproses' ? 'bg-blue-50 text-blue-700' :
                                'bg-amber-50 text-amber-700') }}">
                                {{ $pesanan->STATUS }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="{{ route('pesanan.show', $pesanan->ID_PESANAN) }}" class="text-gray-500 hover:text-rewear-primary" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('pesanan.edit', $pesanan->ID_PESANAN) }}" class="text-gray-500 hover:text-blue-600" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('pesanan.destroy', $pesanan->ID_PESANAN) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-400">
                            Belum ada data pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
