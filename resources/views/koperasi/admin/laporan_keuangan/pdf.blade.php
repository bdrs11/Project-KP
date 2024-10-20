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
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Transaksi</h2>
    <p style="text-align: center;">Tahun: 2024</p>

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
            @php $num = 1; @endphp
            @foreach($reports as $report)
            <tr>
                <td>{{ $num++ }}</td>
                <td>{{ $report->sale->nama_barang }}</td>
                <td>{{ number_format($report->sale->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $report->sale->jumlah_barang }}</td>
                <td>{{ number_format($report->pemasukan, 0, ',', '.') }}</td>
                <td>{{ $report->tanggal_transaksi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
