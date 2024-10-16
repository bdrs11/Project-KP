<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'nama_barang',
        'goodid',
        'jumlah_barang',
        'harga_satuan',
        'total_harga',
        'tanggal_penjualan'
    ];

    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goodid');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'saleid');
    }
}
