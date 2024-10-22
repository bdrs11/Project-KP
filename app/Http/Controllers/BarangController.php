<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data['goods'] = Goods::all();
        return view('daftar_barang', $data);
    }
}
