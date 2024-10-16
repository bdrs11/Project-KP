<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah produk
        $totalProducts = Goods::count();
        
        // Menghitung jumlah transaksi
        $totalTransactions = Sale::count();
        
        // Menghitung jumlah user
        $totalUsers = User::count();

        // Mengirim data ke view
        return view('dashboard', compact('totalProducts', 'totalTransactions', 'totalUsers'));
    }
}
