<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('koperasi.pengguna.anggota.index', $data);
    }

    public function create()
    {
        return view('koperasi.pengguna.anggota.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        $users = User::create($validatedData);

        if ($users) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Anggota Created Successfully';
            return redirect()->route('koperasi.pengguna.anggota')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Create Anggota';
            return redirect()->route('koperasi.pengguna.anggota.store')->withInput()->with($notification);
        }
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('koperasi.pengguna.anggota.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
        ]);

        $users = User::findOrFail($id);

        $users->update($validatedData);

        if ($users) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Anggota Successfully Updated';
            return redirect()->route('koperasi.pengguna.anggota')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Anggota';
            return redirect()->route('koperasi.pengguna.anggota.update')->withInput()->with($notification);
        }
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        if ($users) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Anggota Deleted Successfully';
            return redirect()->route('koperasi.pengguna.anggota')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Delete Anggota';
            return redirect()->route('koperasi.pengguna.anggota')->withInput()->with($notification);
        }
    }

    public function display()
    {
        $data['anggota'] = User::all();
        return view('koperasi.admin.anggota.index', $data);
    }
}
