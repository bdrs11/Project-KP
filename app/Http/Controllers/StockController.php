<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $data['goods'] = Goods::all();
        return view('koperasi.admin.kelola_stock.index', $data);
    }

    public function edit($id)
    {
        $goods = Goods::findOrFail($id);

        return view('koperasi.admin.kelola_stock.edit', compact('goods'));
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
            $notification['message'] = 'Stock Successfully Updated';
            return redirect()->route('koperasi.admin.kelola_stock')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Stock';
            return redirect()->route('koperasi.admin.kelola_stock.update')->withInput()->with($notification);
        }
    }

}
