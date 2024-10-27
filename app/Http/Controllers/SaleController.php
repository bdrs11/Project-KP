<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua item penjualan dan grup berdasarkan tanggal dan waktu
        $sale_items = SaleItem::with('good', 'sale')
            ->orderBy('tanggal_penjualan', 'desc') // Ubah ke 'desc' untuk urutan terbaru di atas
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal_penjualan)->format('Y-m-d H:i:s'); // Format tanggal dan waktu
            });
    
        return view('koperasi.admin.penjualan.index', compact('sale_items'));
    }     

    public function create()
    {
        $data['goods'] = Goods::all();

        return view('koperasi.admin.penjualan.create', $data);
    }

    public function store(Request $request)
    {
        // Validasi input terlebih dahulu
        $validatedData = $request->validate([
            'total_harga' => 'required|numeric',
            'jumlah_uang' => 'required|numeric',
            'kembalian' => 'required|numeric',
            'selected_goods' => 'required|json'
        ]);

        // Decode data barang yang dipilih
        $selectedGoods = json_decode($request->input('selected_goods'), true);

        // Pastikan barang yang dipilih tidak kosong
        if (empty($selectedGoods)) {
            return back()->withErrors(['error' => 'Tidak ada barang yang dipilih.']);
        }

        DB::beginTransaction();
        try {
            // Buat data transaksi baru di tabel sales
            $sale = new Sale();
            $sale->userid = Auth::id(); // Set user_id dengan id pengguna yang sedang login
            $sale->total_harga = $request->input('total_harga');
            $sale->jumlah_uang = $request->input('jumlah_uang');
            $sale->kembalian = $request->input('kembalian');
            $sale->save();

            // Simpan setiap barang yang dipilih ke dalam tabel sale_items
            foreach ($selectedGoods as $good) {
                // Simpan item penjualan
                DB::table('sale_items')->insert([
                    'saleid' => $sale->id, // Foreign key untuk transaksi
                    'goodid' => $good['id'], // Foreign key untuk barang
                    'jumlah' => $good['jumlah'], // Jumlah barang
                    'harga_satuan' => $good['harga'], // Harga satuan
                    'total_harga' => $good['harga'] * $good['jumlah'], // Total harga
                ]);

                // Kurangi jumlah barang di tabel goods
                $item = Goods::find($good['id']);
                if ($item) {
                    // Pastikan stok cukup
                    if ($item->jumlah >= $good['jumlah']) {
                        $item->jumlah -= $good['jumlah'];
                        $item->save();
                    } else {
                        // Kembalikan error jika stok tidak cukup
                        DB::rollBack();
                        return back()->withErrors(['error' => 'Stok tidak cukup untuk barang: ' . $item->nama_barang]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('koperasi.admin.penjualan')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function printStruk($id)
    {
        // Memuat relasi saleItems dan user
        $sale = Sale::with(['saleItems.good', 'user'])->findOrFail($id);
    
        return view('koperasi.admin.penjualan.struk', [
            'sale' => $sale,
            'sale_items' => $sale->saleItems,
        ]);
    }     
    
    public function destroy($id)
    {
        $sales = Sale::findOrFail($id);
        $sales->delete();

        if ($sales) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Penjualan Deleted Successfully';
            return redirect()->route('koperasi.admin.penjualan')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Delete Penjualan';
            return redirect()->route('koperasi.admin.penjualan')->withInput()->with($notification);
        }
    }

    public function display()
    {
        $data['sales'] = Sale::all();
        return view('koperasi.admin.penjualan.index', $data);
    }

}
