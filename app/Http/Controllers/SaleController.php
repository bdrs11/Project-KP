<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $data['sales'] = Sale::all();

        return view('koperasi.admin.penjualan.index', $data);
    }

    public function create()
    {
        $data['goods'] = Goods::all();

        return view('koperasi.admin.penjualan.create', $data);
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'goodid' => 'required|exists:goods,id',
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Ambil data barang dari tabel goods
        $barang = Goods::findOrFail($validatedData['goodid']);

        // Buat data penjualan
        $sales = Sale::create([
            'nama_barang' => $barang->nama_barang,
            'goodid' => $validatedData['goodid'],
            'jumlah_barang' => $validatedData['jumlah_barang'],
            'harga_satuan' => $validatedData['harga_satuan'],
            'total_harga' => $validatedData['total_harga'],
        ]);

        // Cek apakah penjualan berhasil disimpan
        if ($sales) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Transaksi Created Successfully';
            return redirect()->route('koperasi.admin.penjualan')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Create Transaksi';
            return redirect()->route('koperasi.admin.penjualan.store')->withInput()->with($notification);
        }
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
