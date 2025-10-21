<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail';
    public $timestamps = true;

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'qty',
        'subtotal'
    ];

    // 🔹 Tambahkan relasi ke tabel transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
