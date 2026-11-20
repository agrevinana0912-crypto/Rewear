<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk preloved dan metrik dashboard.
     */
    public function index()
    {
        $products = Product::latest()->get();

        $totalProduk = $products->count();
        $produkReady = $products->where('stok', '>', 0)->count();
        $totalKategori = $products->pluck('kategori')->filter()->unique()->count();
        $totalStok = $products->sum('stok');

        return view('products.index', compact('products', 'totalProduk', 'totalStok', 'produkReady', 'totalKategori'));
    }

    /**
     * Menampilkan formulir tambah produk preloved baru.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan data produk preloved baru beserta upload foto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'ukuran'      => 'nullable|string|max:50',
            'kondisi'     => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('foto');

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk preloved berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail spesifik produk preloved.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan formulir edit produk preloved.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Memperbarui data produk preloved dan mengganti foto jika diunggah baru.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'ukuran'      => 'nullable|string|max:50',
            'kondisi'     => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk preloved berhasil diperbarui!');
    }

    /**
     * Menghapus produk preloved dan file fotonya dari storage.
     */
    public function destroy(Product $product)
    {
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk preloved berhasil dihapus!');
    }
}
