<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Produk::all(); // untuk form tambah transaksi
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get(); // untuk tabel transaksi

        return view('transaksi.index', compact('produk', 'transaksi'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('transaksi.create', compact('produk'));
    }
    public function store(Request $request)
    {
        if (!$request->has('produk_id')) {
            return back()->with('error', 'Pilih minimal satu produk untuk transaksi.');
        }

        $total = 0;
        $produkDipilih = [];

        foreach ($request->produk_id as $id) {
            $qty = (int) ($request->qty[$id] ?? 0);

            if ($qty > 0) {
                $produk = Produk::find($id);
                if ($produk) {
                    $pajak = ($produk->pajak / 100) * ($produk->harga * $qty);
                    $subtotal = ($produk->harga * $qty) + $pajak;
                    $total += $subtotal;


                    $produkDipilih[] = [
                        'produk' => $produk,
                        'qty' => $qty,
                        'pajak'=>$pajak,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        if (empty($produkDipilih)) {
            return back()->with('error', 'Isi jumlah (qty) minimal satu produk yang dipilih.');
        }

    // ✅ Hitung total qty semua item
        $totalQty = array_sum(array_column($produkDipilih, 'qty'));

    // ✅ Simpan transaksi utama
        $transaksi = Transaksi::create([
            'tanggal' => now(),
            'qty'     => $totalQty,
            'pajak'     => $pajak,
            'total'   => $total,
        ]);

    // ✅ Simpan detail transaksi & kurangi stok produk
    foreach ($produkDipilih as $item) {
        DetailTransaksi::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'id_produk'    => $item['produk']->id_produk,
            'qty'          => $item['qty'],
            'subtotal'     => $item['subtotal'],
        ]);

        // $item['produk']->stok -= $item['qty'];
        // $item['produk']->save();
    }

    return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan.');
}


}
