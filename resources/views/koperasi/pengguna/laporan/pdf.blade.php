<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penerimaan Barang & Stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        h2 {
            text-align: center;
        }
        .signature-section {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .signature {
            text-align: center;
            margin-right: 50px;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid black;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Stock Barang</h2>
    <p style="text-align: center;">Laporan Pemerimaan barang dan stock pada koperasi sekolah SMP Suryacendikia Bulan {{ DateTime::createFromFormat('!m', $month)->format('F') }} Tahun {{ $year }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga (Rp)</th>
                <th>Total Terjual</th>
                <th>Stock Tersisa</th>
                <th>Tanggal Stok Masuk</th>
            </tr>
        </thead>
        <tbody>
            @php $num = 1; @endphp
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $report->goods->nama_barang ?? 'Tidak ada data' }}</td>
                    <td>{{ number_format($report->goods->harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $report->total_terjual ?? 'Tidak ada data' }}</td>
                    <td>{{ $report->goods->jumlah ?? 'Tidak ada data' }}</td>
                    <td>{{ $report->tanggal_stok_masuk ?? 'Tidak ada data' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda Tangan Section -->
    <div class="signature-section">
        <div class="signature">
            <p>Petugas Koperasi</p>
            <div class="signature-line">Badrussalam</div>
        </div>
    </div>
</body>
</html>
