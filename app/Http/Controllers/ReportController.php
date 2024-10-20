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
            $totalTerjual = $sales->where('goodid', $good->id)->sum('jumlah_barang');
            $totalPemasukan = $sales->where('goodid', $good->id)->sum('total_harga');

            $reports[] = (object)[
                'goods' => $good,
                'total_terjual' => $totalTerjual,
                'total_pemasukan' => $totalPemasukan,
            ];
        }

        return view('koperasi.pengguna.laporan.index', compact('reports', 'month', 'year'));
    }

    public function cetakPDF(Request $request)
    {
        // Ambil data yang sama seperti pada tampilan laporan
        $reports = Report::with(['goods'])->get();  // Ganti sesuai dengan query yang kamu gunakan untuk laporan

        // Muat view laporan dan kirim data ke dalamnya
        $pdf =FacadePdf::loadView('koperasi.pengguna.laporan.pdf', compact('reports'));
        
        // Unduh atau tampilkan PDF
        return $pdf->download('laporan_stock.pdf');
    }
}
