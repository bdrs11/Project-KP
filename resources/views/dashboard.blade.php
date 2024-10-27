<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-gray-600">Selamat Datang, {{ Auth::user()->name }}!</p> 
    </x-slot>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .dashboard-card {
                padding: 20px;
                border-radius: 10px;
                color: white;
            }
            .dashboard-card h5 {
                font-size: 16px;
                margin-bottom: 5px;
            }
            .dashboard-card .count {
                font-size: 24px;
                font-weight: bold;
            }
            .card-product {
                background-color: #FF9800; 
            }
            .card-transaction {
                background-color: #673AB7; 
            }
            .card-user {
                background-color: #4CAF50; 
            }
        </style>
    </head>
    <body>
        <div class="container my-5">
            <div class="d-flex justify-content-center gap-3 text-center">
                <div class="dashboard-card card-product col-md-3">
                    <h5>Jumlah Produk</h5>
                    <div class="count">{{ $totalProducts }} Produk</div>
                </div>
                <div class="dashboard-card card-transaction col-md-3">
                    <h5>Total Transaksi</h5>
                    <div class="count">{{ $totalTransactions }} Transaksi</div>
                </div>
                <div class="dashboard-card card-user col-md-3">
                    <h5>Total User</h5>
                    <div class="count">{{ $totalUsers }} User</div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

</x-app-layout>