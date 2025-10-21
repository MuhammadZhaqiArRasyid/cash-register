<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil total pendapatan (jumlah total dari transaksi)
        $totalPendapatan = Transaksi::sum('total');

        // Hitung jumlah transaksi
        $totalTransaksi = Transaksi::count();

        // Hitung jumlah menu terjual (total qty dari detail transaksi)
        $totalMenuTerjual = DetailTransaksi::sum('qty');

        // Ambil 5 transaksi terbaru
        $transaksiTerbaru = Transaksi::orderBy('tanggal','desc')->limit(5)->get();

        // Kirim ke view
        return view('dashboard', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalMenuTerjual',
            'transaksiTerbaru'
        ));
    }
}
