<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data['suppliers'] = Supplier::all();
        return view('koperasi.admin.suppliers.index', $data);
    }

    public function create()
    {
        return view('koperasi.admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $supplier = Supplier::create($validatedData);

        if ($supplier) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Supplier Created Successfully';
            return redirect()->route('koperasi.admin.suppliers')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Create Supplier';
            return redirect()->route('koperasi.admin.suppliers.store')->withInput()->with($notification);
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('koperasi.admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update($validatedData);

        if ($supplier) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Supplier Successfully Updated';
            return redirect()->route('koperasi.admin.suppliers')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Supplier';
            return redirect()->route('koperasi.admin.suppliers.update')->withInput()->with($notification);
        }
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        if ($supplier) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Supplier Deleted Successfully';
            return redirect()->route('koperasi.admin.suppliers')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Delete Supplier';
            return redirect()->route('koperasi.admin.suppliers')->withInput()->with($notification);
        }
    }

    public function display()
    {
        $data['suppliers'] = Supplier::all();
        return view('koperasi.admin.suppliers.index', $data);
    }
}