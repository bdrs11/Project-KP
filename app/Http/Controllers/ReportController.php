<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Report;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default bulan dan tahun saat ini
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
    
        // Ambil data penjualan berdasarkan filter bulan dan tahun
        $sales = Sale::whereYear('tanggal_penjualan', $year)
                    ->whereMonth('tanggal_penjualan', $month)
                    ->get();
    
        // Ambil semua barang
        $goods = Goods::all();
    
        // Buat array untuk menampung laporan
        $reports = [];
    
        foreach ($goods as $good) {
            // Total barang terjual
            $totalTerjual = $sales->where('goodid', $good->id)->sum('jumlah_barang');
            // Total pemasukan
            $totalPemasukan = $sales->where('goodid', $good->id)->sum('total_harga');
            // Stock tersisa
            $stockTersisa = $good->jumlah - $totalTerjual;
    
            // Menyimpan laporan
            $reports[] = (object)[
                'goods' => $good,
                'total_terjual' => $totalTerjual,
                'stock_tersisa' => $stockTersisa,
                'total_pemasukan' => $totalPemasukan,
                'tanggal_stok_masuk' => $good->tanggal_masuk, // Pastikan field ini ada di model Goods
            ];
        }
    
        return view('koperasi.pengguna.laporan.index', compact('reports', 'month', 'year'));
    }    

    public function cetakPdf(Request $request)
    {
        // Default bulan dan tahun saat ini
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
    
        // Ambil data penjualan berdasarkan filter bulan dan tahun
        $sales = Sale::whereYear('tanggal_penjualan', $year)
                    ->whereMonth('tanggal_penjualan', $month)
                    ->get();
    
        // Ambil semua barang
        $goods = Goods::all();
    
        // Buat array untuk menampung laporan
        $reports = [];
    
        foreach ($goods as $good) {
            // Total barang terjual
            $totalTerjual = $sales->where('goodid', $good->id)->sum('jumlah_barang');
            // Stock tersisa
            $stockTersisa = $good->jumlah - $totalTerjual;
    
            // Menyimpan laporan
            $reports[] = (object)[
                'goods' => $good,
                'total_terjual' => $totalTerjual,
                'stock_tersisa' => $stockTersisa,
                'tanggal_stok_masuk' => $good->tanggal_masuk, // Pastikan field ini ada di model Goods
            ];
        }
    
        // Generate PDF menggunakan view 'koperasi.pengguna.laporan.pdf'
        $pdf = FacadePdf::loadView('koperasi.pengguna.laporan.pdf', compact('reports', 'month', 'year'));
    
        return $pdf->download('laporan-barang-' . $month . '-' . $year . '.pdf');
    }
    
}
