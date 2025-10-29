<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use App\Exports\Exportlaporan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = [];

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $transaksis = Transaksi::whereBetween('tanggal', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ])->get();
        }

        return view('laporan.index', compact('transaksis'));
    }

    public function export(Request $request)
    {
        $sheet = Excel::download(
        new Exportlaporan($request->tanggal_awal, $request->tanggal_akhir),
        'laporan-transaksi.xlsx'
        );
    return $sheet;
    
    }

    public function exportPDF(Request $request)
{
    $transaksis = [];

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $transaksis = \App\Models\Transaksi::whereBetween('tanggal', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ])->get();
    }

    $pdf = Pdf::loadView('laporan.pdf', compact('transaksis'))
              ->setPaper('A4', 'portrait');

    return $pdf->download('laporan-transaksi.pdf');
}
}
