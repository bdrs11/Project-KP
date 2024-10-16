<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Report;
use App\Models\ReportSale;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil data penjualan
        $sales = Sale::all();
        $goods = Goods::all();
    
        // Loop data penjualan untuk dimasukkan ke report_sales
        foreach ($sales as $sale) {
            $existingReport = ReportSale::where('saleid', $sale->id)->first();
    
            // Cek apakah data sudah ada di report_sales untuk mencegah duplikasi
            if (!$existingReport) {
                ReportSale::create([
                    'tanggal_transaksi' => $sale->tanggal_penjualan,
                    'pemasukan' => $sale->total_harga,
                    'keterangan' => 'Penjualan ' . $sale->nama_barang,
                    'saleid' => $sale->id,
                ]);
            }
        }
    
        // Ambil data laporan penjualan (report_sales)
        $reports = ReportSale::with('sale','good')->get();
    
        return view('koperasi.pengguna.laporan.index', compact('reports'));
    }
}
