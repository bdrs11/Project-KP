<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Report;
use App\Models\Sale;
use App\Models\SaleItem;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default bulan dan tahun saat ini
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
    
        // Ambil barang yang masuk pada bulan dan tahun yang dipilih
        $goods = Goods::whereYear('tanggal_masuk', $year)
                      ->whereMonth('tanggal_masuk', $month)
                      ->get();
    
        // Buat array untuk menampung laporan
        $reports = [];
    
        foreach ($goods as $good) {

            // Menyimpan laporan
            $reports[] = (object)[
                'goods' => $good,
                'tanggal_stok_masuk' => $good->tanggal_masuk, 
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
        $sale_items = SaleItem::whereYear('tanggal_penjualan', $year)
                    ->whereMonth('tanggal_penjualan', $month)
                    ->get();
    
        // Ambil barang yang masuk pada bulan dan tahun yang dipilih
        $goods = Goods::whereYear('tanggal_masuk', $year)
                      ->whereMonth('tanggal_masuk', $month)
                      ->get();
    
        $reports = [];
    
        foreach ($goods as $good) {
            // Total barang terjual
            $totalTerjual = $sale_items->where('goodid', $good->id)->sum('jumlah_barang');

            $stockTersisa = $good->jumlah - $totalTerjual;
    
            // Menyimpan laporan
            $reports[] = (object)[
                'goods' => $good,
                'total_terjual' => $totalTerjual,
                'stock_tersisa' => $stockTersisa,
                'tanggal_stok_masuk' => $good->updated_at,
            ];
        }
    
        // Generate PDF menggunakan view 'koperasi.pengguna.laporan.pdf'
        $pdf = FacadePdf::loadView('koperasi.pengguna.laporan.pdf', compact('reports', 'month', 'year'));
    
        return $pdf->download('laporan-barang-' . $month . '-' . $year . '.pdf');
    }    
}
