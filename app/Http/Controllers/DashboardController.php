<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $totalPendapatan = Transaksi::whereDate('tanggal', $today)->sum('total');
        $totalTransaksi = Transaksi::whereDate('tanggal', $today)->count();
        $totalMenuTerjual = DetailTransaksi::whereHas('transaksi', function($query) use ($today) {
            $query->whereDate('tanggal', $today);
        })->sum('qty');
        $totalPajak = Transaksi::whereDate('tanggal', $today)->sum('pajak');

        // Ambil 5 transaksi terbaru (semua, bukan cuma hari ini)
        $transaksiTerbaru = Transaksi::orderBy('tanggal', 'desc')->limit(5)->get();

        // Total pajak HARI INI
       

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
