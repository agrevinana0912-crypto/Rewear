<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use App\Models\UserRewear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $pesanans = Pesanan::with('userRewear')->orderBy('ID_PESANAN', 'desc')->get();

        $totalPesanan = $pesanans->count();
        $totalProses = $pesanans->where('STATUS', 'Diproses')->count();
        $totalSelesai = $pesanans->where('STATUS', 'Selesai')->count();

        return view('pesanan.index', compact(
            'pesanans',
            'totalPesanan',
            'totalProses',
            'totalSelesai'
        ));
    }

    // Menampilkan form tambah pesanan
    public function create()
    {
        $users = UserRewear::all();
        $produks = Produk::all();

        return view('pesanan.create', compact('users', 'produks'));
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'ID_USER' => 'required|exists:user_rewear,ID_USER',
            'ID_PRODUK' => 'required|exists:produk,ID_PRODUK',
            'JUMLAH' => 'required|integer|min:1',
            'STATUS' => 'required|in:Diproses,Dikirim,Selesai,Dibatalkan',
        ]);

        DB::transaction(function () use ($request) {
            $produk = Produk::where('ID_PRODUK', $request->ID_PRODUK)
                ->lockForUpdate()
                ->firstOrFail();

            if ($produk->STOK < $request->JUMLAH) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'JUMLAH' => 'Stok produk tidak mencukupi.',
                ]);
            }

            $totalHarga = $produk->HARGA * $request->JUMLAH;

            $pesanan = Pesanan::create([
                'ID_USER' => $request->ID_USER,
                'TANGGAL' => now()->toDateString(),
                'TOTAL_HARGA' => $totalHarga,
                'STATUS' => $request->STATUS,
            ]);

            DetailPesanan::create([
                'ID_PESANAN' => $pesanan->ID_PESANAN,
                'ID_PRODUK' => $produk->ID_PRODUK,
                'JUMLAH' => $request->JUMLAH,
            ]);

            $produk->decrement('STOK', $request->JUMLAH);
        });

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pesanan::with([
            'userRewear',
            'detailPesanan.produk'
        ])->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }

    // Menampilkan form edit pesanan
    public function edit($id)
    {
        $pesanan = Pesanan::with('userRewear')->findOrFail($id);
        $users = UserRewear::all();

        return view('pesanan.edit', compact('pesanan', 'users'));
    }

    // Memperbarui pesanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_USER' => 'required|exists:user_rewear,ID_USER',
            'STATUS' => 'required|in:Diproses,Dikirim,Selesai,Dibatalkan',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'ID_USER' => $request->ID_USER,
            'STATUS' => $request->STATUS,
        ]);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui!');
    }

    // Menghapus pesanan
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pesanan = Pesanan::with('detailPesanan')->findOrFail($id);

            foreach ($pesanan->detailPesanan as $detail) {
                $produk = Produk::where('ID_PRODUK', $detail->ID_PRODUK)
                    ->lockForUpdate()
                    ->first();

                if ($produk) {
                    $produk->increment('STOK', $detail->JUMLAH);
                }
            }

            $pesanan->detailPesanan()->delete();
            $pesanan->delete();
        });

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus!');
    }
}
