<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil tanggal hari ini
        $today = now()->toDateString();

        // Ambil total pendapatan HARI INI
        $totalPendapatan = Transaksi::whereDate('tanggal', $today)->sum('total');

        // Hitung jumlah transaksi HARI INI
        $totalTransaksi = Transaksi::whereDate('tanggal', $today)->count();

        // Hitung jumlah menu terjual HARI INI
        $totalMenuTerjual = DetailTransaksi::whereHas('transaksi', function($query) use ($today) {
            $query->whereDate('tanggal', $today);
        })->sum('qty');

        // Ambil 5 transaksi terbaru (semua, bukan cuma hari ini)
        $transaksiTerbaru = Transaksi::orderBy('tanggal', 'desc')->limit(5)->get();

        // Total pajak HARI INI
        $totalPajak = Transaksi::whereDate('tanggal', $today)->sum('pajak');

        // Kirim ke view
        return view('dashboard', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalMenuTerjual',
            'totalPajak',
            'transaksiTerbaru'
        ));
    }
}
