@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100">

    <div class="mb-6 pb-4 border-b border-gray-100">
        <h1 class="text-xl font-bold text-rewear-dark">
            Edit Pesanan #{{ $pesanan->ID_PESANAN }}
        </h1>
        <p class="text-xs text-gray-500 mt-0.5">Perbarui informasi pesanan.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('pesanan.update', $pesanan->ID_PESANAN) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Pembeli</label>
            <select name="ID_USER" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm bg-white">
                @foreach($users as $user)
                    <option value="{{ $user->ID_USER }}"
                        {{ old('ID_USER', $pesanan->ID_USER) == $user->ID_USER ? 'selected' : '' }}>
                        {{ $user->NAMA }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status Pesanan</label>
            <select name="STATUS" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm bg-white">
                @foreach(['Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'] as $status)
                    <option value="{{ $status }}"
                        {{ old('STATUS', $pesanan->STATUS) == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-3">
            <a href="{{ route('pesanan.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-rewear-primary text-white rounded-lg text-sm font-medium">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
