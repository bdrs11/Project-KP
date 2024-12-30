<?php

namespace App\Http\Controllers;

use App\Models\ReportSale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ReportSaleController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan bulan dan tahun yang dipilih dari request (default ke bulan/tahun sekarang)
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
    
        // Memfilter penjualan berdasarkan bulan dan tahun yang dipilih
        $sale_items = SaleItem::with('sale.goods') 
            ->whereMonth('tanggal_penjualan', $month)
            ->whereYear('tanggal_penjualan', $year)
            ->get();
    
        // Mengambil laporan penjualan berdasarkan bulan dan tahun yang dipilih
        $reports = $sale_items->map(function ($saleItem) {
            return (object) [
                'sale_item' => $saleItem,
                'pemasukan' => $saleItem->total_harga,
                'tanggal_transaksi' => $saleItem->tanggal_penjualan,
                'jumlah_barang' => $saleItem->jumlah,
            ];
        });
    
        // Memasukkan data penjualan ke dalam ReportSale jika belum ada
        foreach ($sale_items as $saleItem) {
            $existingReport = ReportSale::where('saleid', $saleItem->saleid)
                ->whereMonth('tanggal_transaksi', $month)
                ->whereYear('tanggal_transaksi', $year)
                ->first();
    
            if (!$existingReport) {
                // Memastikan 'sale' dan 'goods' tidak null sebelum mencoba mengakses 'nama_barang'
                $keterangan = 'Penjualan';
                if ($saleItem->sale && $saleItem->sale->goods) {
                    $keterangan .= ' ' . $saleItem->sale->goods->nama_barang;
                }
    
                ReportSale::create([
                    'tanggal_transaksi' => $saleItem->tanggal_penjualan,
                    'pemasukan' => $saleItem->total_harga,
                    'saleid' => $saleItem->saleid,
                ]);
            }
        }
    
        return view('koperasi.admin.laporan_keuangan.index', compact('reports', 'month', 'year'));
    }             

    public function cetakPDF(Request $request)
    {
        // Ambil data yang sama seperti pada tampilan laporan
        $report_sales = ReportSale::with(['sale', 'saleItems.good'])->get();
    
        // Muat view laporan dan kirim data ke dalamnya
        $pdf = FacadePdf::loadView('koperasi.admin.laporan_keuangan.pdf', compact('report_sales'));
        
        // Unduh atau tampilkan PDF
        return $pdf->download('laporan_stock.pdf');
    }  
}
