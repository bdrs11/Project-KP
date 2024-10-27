<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Koperasi Sekolah SMP Suryacendikia</h2>
    <p style="text-align: center;">Laporan Transaksi</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga (Rp)</th>
                <th>Total Terjual</th>
                <th>Uang Masuk (Rp)</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $num = 1;
                $totalTerjual = 0;
                $totalUangMasuk = 0;
            @endphp
            @foreach($report_sales as $report)
                @foreach($report->saleItems as $saleItem) <!-- Loop untuk saleItems -->
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $saleItem->good->nama_barang ?? 'Data tidak tersedia' }}</td>
                    <td>{{ number_format($saleItem->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $saleItem->jumlah ?? 0 }}</td> <!-- Pastikan Anda mengakses jumlah yang benar -->
                    <td>{{ number_format($report->pemasukan, 0, ',', '.') }}</td>
                    <td>{{ $report->tanggal_transaksi }}</td>
                </tr>
                @endforeach
                @php
                    // Summing up the total values
                    $totalTerjual += $report->saleItems->sum('jumlah'); // Jumlah total dari semua saleItems
                    $totalUangMasuk += $report->pemasukan; // Pastikan ini sesuai dengan logika bisnis Anda
                @endphp
            @endforeach
        </tbody>        
        
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total</td>
                <td>{{ $totalTerjual }}</td>
                <td>{{ number_format($totalUangMasuk, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
