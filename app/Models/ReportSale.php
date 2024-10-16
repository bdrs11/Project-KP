<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSale extends Model
{
    protected $fillable = [
        'tanggal_transaksi',
        'pemasukan',
        'keterangan',
        'saleid',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'saleid');
    }

    public function good()
    {
        return $this->hasOneThrough(Goods::class, Sale::class, 'id', 'id', 'saleid', 'goodid');
    }
}

