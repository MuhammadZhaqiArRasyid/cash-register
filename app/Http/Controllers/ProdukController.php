<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // menampilkan index dengan variabel lengkap
    public function index()
    {
        // data per kategori
        $makanan = Produk::where('kategori', 'makanan')->get();
        $minuman = Produk::where('kategori', 'minuman')->get();

        // juga kirim $produk supaya view lama yg masih pakai $produk tidak error
        $produk = Produk::all();

        // debug singkat (hapus/komentari setelah berhasil)
        // \Log::info('ProdukController@index hit', ['makanan' => $makanan->count(), 'minuman' => $minuman->count(), 'produk' => $produk->count()]);

        return view('produk.index', compact('makanan', 'minuman', 'produk'));
    }

    public function create() { return view('produk.create'); }

public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'kategori' => 'required|string',
        'harga' => 'required|numeric',
        'pajak' => 'required|numeric|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $nama_file = null;

    // Jika user upload gambar
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/produk'), $nama_file);
    }

    Produk::create([
        'nama_produk' => $request->nama_produk,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'pajak' => $request->pajak,
        'gambar' => $nama_file, // boleh null
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}


    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'kategori' => 'required|string',
        'harga' => 'required|numeric',
        'pajak' => 'required|numeric|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update data
    $produk->nama_produk = $request->nama_produk;
    $produk->kategori = $request->kategori;
    $produk->harga = $request->harga;
    $produk->pajak = $request->pajak;

    // Jika user upload gambar baru
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/produk'), $nama_file);
        $produk->gambar = $nama_file;
    }

    $produk->save(); // simpan ke database

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
}



    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success','Produk dihapus.');
    }
}
