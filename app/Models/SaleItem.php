<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $table = 'sale_items'; 

    protected $fillable = [
        'saleid', 
        'goodid', 
        'jumlah', 
        'harga_satuan', 
        'total_harga'
    ];

    // Relasi ke Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'saleid');
    }

    // Relasi ke Goods
    public function good() 
    {
        return $this->belongsTo(Goods::class, 'goodid'); 
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
