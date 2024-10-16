<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
            background-color: #FF9800; /* Color for product */
        }
        .card-transaction {
            background-color: #673AB7; /* Color for transaction */
        }
        .card-user {
            background-color: #4CAF50; /* Color for user */
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="dashboard-card card-product">
                    <h5>Jumlah Produk</h5>
                    <!-- Menampilkan jumlah produk dari controller -->
                    <div class="count">{{ $totalProducts }} Produk</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card card-transaction">
                    <h5>Total Transaksi</h5>
                    <!-- Menampilkan total transaksi dari controller -->
                    <div class="count">{{ $totalTransactions }} Transaksi</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card card-user">
                    <h5>Total User</h5>
                    <!-- Menampilkan total user dari controller -->
                    <div class="count">{{ $totalUsers }} User</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</x-app-layout>
