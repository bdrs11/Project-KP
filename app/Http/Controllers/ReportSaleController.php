<?php

namespace App\Http\Controllers;

use App\Models\ReportSale;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportSaleController extends Controller
{
    public function index()
    {
        // Ambil data penjualan
        $sales = Sale::all();
    
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
        $reports = ReportSale::with('sale')->get();
    
        return view('koperasi.admin.laporan_keuangan.index', compact('reports'));
    }
}