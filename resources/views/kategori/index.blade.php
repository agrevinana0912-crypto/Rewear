
@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

        <div>
            <h1 class="text-2xl font-bold text-rewear-dark">
                Manajemen Kategori
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola kategori produk preloved ReWear dengan mudah.
            </p>
        </div>

        <a href="{{ route('kategori.create') }}"
           class="bg-rewear-primary hover:bg-opacity-90 text-white px-4 py-2.5 rounded-lg text-sm font-medium shadow-sm transition flex items-center gap-2">

            <i class="fa-solid fa-plus"></i>
            Tambah Kategori

        </a>

    </div>


    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">

            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">
                    Total Kategori
                </p>

                <h3 class="text-2xl font-bold text-rewear-dark mt-2">
                    {{ $totalKategori }}
                </h3>
            </div>

            <div class="p-3 bg-rewear-light rounded-lg text-rewear-primary">
                <i class="fa-solid fa-tags text-xl"></i>
            </div>

        </div>


        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">

            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">
                    Hasil Ditampilkan
                </p>

                <h3 class="text-2xl font-bold text-emerald-600 mt-2">
                    {{ $kategori->count() }}
                </h3>
            </div>

            <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                <i class="fa-solid fa-list-check text-xl"></i>
            </div>

        </div>


        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">

            <div>
                <p class="text-xs text-gray-500 font-medium uppercase">
                    Data Ditemukan
                </p>

                <h3 class="text-2xl font-bold text-rewear-secondary mt-2">
                    {{ $kategori->total() }}
                </h3>
            </div>

            <div class="p-3 bg-stone-100 rounded-lg text-stone-600">
                <i class="fa-solid fa-database text-xl"></i>
            </div>

        </div>

    </div>


    <!-- Tabel Kategori -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

            <div>
                <h2 class="text-base font-bold text-rewear-dark">
                    Daftar Kategori
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Semua kategori produk ReWear.
                </p>
            </div>


            <!-- Pencarian -->
            <form action="{{ route('kategori.index') }}"
                  method="GET"
                  class="flex w-full sm:w-auto gap-2">

                <div class="relative flex-1 sm:w-64">

                    <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Cari kategori..."
                           class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-rewear-secondary">

                </div>

                <button type="submit"
                        class="bg-rewear-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-lg text-sm">
                    Cari
                </button>

                @if($search)
                    <a href="{{ route('kategori.index') }}"
                       class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm text-gray-600">
                        Reset
                    </a>
                @endif

            </form>

        </div>


        <!-- Tabel -->
        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">

                        <th class="py-4 px-5 font-semibold text-center w-16">
                            No
                        </th>

                        <th class="py-4 px-5 font-semibold">
                            Nama Kategori
                        </th>

                        <th class="py-4 px-5 font-semibold">
                            Deskripsi
                        </th>

                        <th class="py-4 px-5 font-semibold text-center">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($kategori as $item)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="py-4 px-5 text-center text-gray-500">
                            {{ $kategori->firstItem() + $loop->index }}
                        </td>

                        <td class="py-4 px-5">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-rewear-light text-rewear-primary flex items-center justify-center">
                                    <i class="fa-solid fa-tag"></i>
                                </div>

                                <span class="font-semibold text-rewear-dark">
                                    {{ $item->nama_kategori }}
                                </span>

                            </div>

                        </td>

                        <td class="py-4 px-5 text-gray-600">
                            {{ $item->deskripsi ?: '-' }}
                        </td>


                        <td class="py-4 px-5 text-center whitespace-nowrap">

                            <div class="flex justify-center items-center gap-3">

                                <a href="{{ route('kategori.edit', $item->id) }}"
                                   class="text-gray-500 hover:text-blue-600 transition"
                                   title="Edit kategori">

                                    <i class="fa-solid fa-pen-to-square text-base"></i>

                                </a>


                                <form action="{{ route('kategori.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori {{ addslashes($item->nama_kategori) }}?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-gray-500 hover:text-red-600 transition"
                                            title="Hapus kategori">

                                        <i class="fa-solid fa-trash text-base"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="py-12 text-center">

                            <div class="flex flex-col items-center gap-3">

                                <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center text-gray-300">
                                    <i class="fa-solid fa-tags text-2xl"></i>
                                </div>

                                <div>
                                    <p class="text-base font-semibold text-gray-700">
                                        Belum Ada Kategori
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Silakan tambahkan kategori produk pertama kamu.
                                    </p>
                                </div>

                                <a href="{{ route('kategori.create') }}"
                                   class="mt-2 px-4 py-2 bg-rewear-primary text-white rounded-lg text-xs font-medium">

                                    <i class="fa-solid fa-plus mr-1"></i>
                                    Tambah Kategori

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- Pagination -->
        <div class="p-5 border-t border-gray-100">
            {{ $kategori->links() }}
        </div>

    </div>

</div>

@endsection
