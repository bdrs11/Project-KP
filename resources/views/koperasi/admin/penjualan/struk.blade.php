<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .struk-container {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .text-center {
            text-align: center;
        }
        .divider {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="struk-container">
        <h2 class="text-center">Struk Penjualan</h2>
        <div class="divider"></div>

        <p><strong>Tanggal:</strong> {{ $sale->tanggal_penjualan }}</p>
        <p><strong>Nama Barang:</strong> {{ $sale->nama_barang }}</p>
        <p><strong>Jumlah Barang:</strong> {{ $sale->jumlah_barang }}</p>
        <p><strong>Harga Satuan:</strong> Rp{{ number_format($sale->harga_satuan, 0, ',', '.') }}</p>
        <p><strong>Total Harga:</strong> Rp{{ number_format($sale->total_harga, 0, ',', '.') }}</p>
        <p><strong>Jumlah Uang:</strong> Rp{{ number_format($sale->jumlah_uang, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp{{ number_format($sale->kembalian, 0, ',', '.') }}</p>

        <div class="divider"></div>
        <p class="text-center">Terima Kasih</p>
    </div>

    <script>
        // Otomatis mencetak ketika halaman terbuka
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
