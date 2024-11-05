<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');  // Ambil data dari input pencarian
    
        // Jika ada input pencarian, cari berdasarkan nama_barang
        if ($search) {
            $goods = Goods::where('nama_barang', 'like', '%' . $search . '%')
                          ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu penambahan
                          ->get();
        } else {
            $goods = Goods::orderBy('created_at', 'desc')->get(); 
        }
    
        return view('koperasi.admin.kelola_barang.index', ['goods' => $goods]);
    }      

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('koperasi.admin.kelola_barang.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        // Validasi semua input termasuk categoryId dan supplierId
        $validatedData = $request->validate([
            'categoriesid' => 'required|exists:categories,id', 
            'supplierid' => 'required|exists:suppliers,id', 
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            // 'ukuran' => 'nullable|string|max:255',
            // 'jumlah' => 'required|integer',
            'tanggal_ditambahkan' => 'required|date',
        ]);
    
        $goods = Goods::create($validatedData);
    
        // Beri notifikasi jika berhasil atau gagal
        if ($goods) {
            return redirect()->route('koperasi.admin.kelola_barang')->with([
                'alert-type' => 'success',
                'message' => 'Barang Created Successfully'
            ]);
        } else {
            return redirect()->route('koperasi.admin.kelola_barang.create')->with([
                'alert-type' => 'error',
                'message' => 'Failed to Create Barang'
            ])->withInput();
        }
    }    

    public function edit($id)
    {
        $goods = Goods::findOrFail($id);

        return view('koperasi.admin.kelola_barang.edit', compact('goods'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'ukuran' => 'nullable|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        $goods = Goods::findOrFail($id);

        $goods->update($validatedData);

        if ($goods) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Barang Successfully Updated';
            return redirect()->route('koperasi.admin.kelola_barang')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Barang';
            return redirect()->route('koperasi.admin.kelola_barang.update')->withInput()->with($notification);
        }
    }

    public function destroy(string $id)
    {
        $goods = Goods::findOrFail($id);
        $goods->delete();

        if ($goods) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Barang Deleted Successfully';
            return redirect()->route('koperasi.admin.kelola_barang')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Delete Barang';
            return redirect()->route('koperasi.admin.kelola_barang')->withInput()->with($notification);
        }
    }

    public function display()
    {
        $data['kelola_barang'] = Goods::all();
        return view('koperasi.admin.kelola_barang.index', $data);
    }
}
