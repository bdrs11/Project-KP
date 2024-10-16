<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $table = 'goods';

    protected $fillable = [
        'nama_barang',
        'harga',
        'ukuran',
        'jumlah',
        'tanggal_ditambahkan',
        'categoriesid',
        'supplierid',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoriesid');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierid');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'goodid');
    }
}
