<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Produk;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Transaksi::with(['items.produk'])->latest()->get();
        
        $totalPesanan = $pesanans->count();
        $totalProses = $pesanans->where('status', 'proses')->count();
        $totalSelesai = $pesanans->where('status', 'selesai')->count();

        return view('pesanan.index', compact('pesanans', 'totalPesanan', 'totalProses', 'totalSelesai'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('pesanan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'produk_id' => 'required',
            'status' => 'required|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $hargaProduk = $produk->harga ?? $produk->price ?? 0;

        // 1. Simpan ke tabel Transaksi utama
        $transaksi = Transaksi::create([
            'nama_pembeli' => $request->nama_pembeli,
            'status' => $request->status,
            'total_harga' => $hargaProduk,
        ]);

        // 2. Simpan ke tabel TransaksiItem (jika modelnya ada)
        if (class_exists(TransaksiItem::class)) {
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $request->produk_id,
                'qty' => 1,
                'subtotal' => $hargaProduk,
            ]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pesanan = Transaksi::with('items.produk')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Transaksi::findOrFail($id);
        $produks = Produk::all();
        return view('pesanan.edit', compact('pesanan', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $pesanan = Transaksi::findOrFail($id);
        $pesanan->update([
            'nama_pembeli' => $request->nama_pembeli,
            'status' => $request->status,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pesanan = Transaksi::findOrFail($id);
        
        // Hapus item terkait terlebih dahulu jika ada relasi
        if (method_exists($pesanan, 'items')) {
            $pesanan->items()->delete();
        }
        
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}