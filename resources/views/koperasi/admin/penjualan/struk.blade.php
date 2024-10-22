<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }
        .struk-container {
            width: 260px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .text-center {
            text-align: center;
        }
        .divider {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }
        .item {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .item p {
            margin: 0;
        }
        .total, .cash {
            font-weight: bold;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="struk-container">
        <h2 class="text-center title">Koperasi Sekolah</h2>
        <p class="text-center">Jl. Selagedang, Pagelaran</p>
        <p class="text-center">81529620220414142434</p>
        <div class="divider"></div>

        <p> {{ $sale->tanggal_penjualan }}</p>
        {{-- <p><strong>Karyawan:</strong> {{ $sale->nama_karyawan }}</p> --}}
        <p><strong>No:</strong> {{ $sale->id }}</p>
        <div class="divider"></div>

        <div class="item">
            <p>Nama Barang :</p>
            <p> {{ $sale->nama_barang }}</p>
        </div>
        <div class="item">
            <p>Jumlah Barang :</p>
            <p> {{ $sale->jumlah_barang }}</p>
        </div>
        <div class="item">
            <p>Harga Satuan :</p>
            <p> Rp{{ number_format($sale->harga_satuan, 0, ',', '.') }}</p>
        </div>
        
        <div class="divider"></div>

        <div class="item">
            <p>Sub Total</p>
            <p> Rp{{ number_format($sale->total_harga, 0, ',', '.') }}</p>
        </div>
        <div class="item total">
            <p>Total</p>
            <p> Rp{{ number_format($sale->total_harga, 0, ',', '.') }}</p>
        </div>
        <div class="item cash">
            <p>Bayar (Cash)</p>
            <p> Rp{{ number_format($sale->jumlah_uang, 0, ',', '.') }}</p>
        </div>
        <div class="item">
            <p>Kembali</p>
            <p> Rp{{ number_format($sale->kembalian, 0, ',', '.') }}</p>
        </div>

        <div class="divider"></div>

        <p class="footer">Link Kritik dan Saran:</p>
        <p class="footer"><a href="http://kopsis.com/f/748488">kopsis.com/f/748488</a></p>

        <div class="divider"></div>
        <p class="footer">Terima Kasih</p>
    </div>

    <script>
        // Otomatis mencetak ketika halaman terbuka
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
