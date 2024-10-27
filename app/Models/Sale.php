<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory; // Tambahkan HasFactory untuk mendukung factory

    protected $fillable = [
        'tanggal_penjualan', // Ganti urutan dengan yang lebih tepat
        'jumlah_uang',
        'kembalian',
        'total_harga'
    ];

    // Relasi ke SaleItem
    public function saleItems() // Gunakan nama relasi yang konsisten
    {
        return $this->hasMany(SaleItem::class, 'saleid');
    }

    // Relasi ke Goods jika ada
    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goodid');
    }

    // Relasi ke Report
    public function reports()
    {
        return $this->hasMany(Report::class, 'saleid');
    }

    // App\Models\Sale.php
    public function user()
    {
        return $this->belongsTo(User::class, 'userid'); // pastikan kolom foreign key adalah 'user_id'
    }

}
