<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // ✅ Supaya kolom otomatis menyesuaikan isi
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;       // ✅ Digunakan untuk styling setelah data dibuat
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExportLaporan implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $awal, $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    // 🔹 Ambil data transaksi sesuai rentang tanggal
    public function collection()
    {
        return Transaksi::whereBetween('tanggal', [
            $this->awal . ' 00:00:00',
            $this->akhir . ' 23:59:59'
        ])->select('id_transaksi', 'tanggal', 'qty', 'pajak', 'total')->get();
    }

    // 🔹 Header kolom Excel
    public function headings(): array
    {
        return ['ID Transaksi', 'Tanggal', 'Qty', 'Pajak', 'Total'];
    }

    // 🔹 Styling otomatis setelah sheet dibuat
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Hitung jumlah baris dan kolom
                $highestRow = $sheet->getHighestRow();      // Baris terakhir
                $highestColumn = $sheet->getHighestColumn(); // Kolom terakhir
                $range = "A1:{$highestColumn}{$highestRow}";

                // ✅ Tambahkan border ke seluruh tabel
                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN, // 🔧 Bisa diganti BORDER_MEDIUM
                            'color' => ['argb' => '000000'],       // 🔧 Warna border hitam
                        ],
                    ],
                ]);

                // ✅ Buat header lebih tebal & rata tengah
                $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,                         // 🔧 Menebalkan teks header
                        'size' => 12,                           // 🔧 Ukuran font header
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // ✅ Posisikan isi tabel di tengah (horizontal)
                $sheet->getStyle($range)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ✅ (Opsional) Tinggikan baris header
                $sheet->getRowDimension(1)->setRowHeight(25);

                // ✅ (Opsional) Ubah tinggi baris isi tabel
                for ($i = 2; $i <= $highestRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(20);
                }

                // ✅ (Opsional) Tambah judul besar di atas tabel
                $sheet->insertNewRowBefore(1, 1); // Tambah baris kosong di atas header
                $sheet->mergeCells('A1:' . $highestColumn . '1');
                $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
