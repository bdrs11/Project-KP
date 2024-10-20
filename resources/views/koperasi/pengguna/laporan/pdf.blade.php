<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center">Daftar Stock</h1>
    <p class="text-center">Laporan Daftar Tahun 2024</p>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga (Rp)</th>
                <th>Total Terjual</th>
                <th>Stock Tersisa</th>
                <th>Jumlah Uang Masuk (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @php $num = 1; @endphp
            @foreach ($reports as $report)
            <tr>
                <td>{{ $num++ }}</td>
                <td>{{ $report->goods->nama_barang ?? 'Tidak ada data' }}</td>
                <td>{{ number_format($report->goods->harga ?? 0, 0, ',', '.') }}</td>
                <td>{{ $report->total_terjual ?? 'Tidak ada data' }}</td>
                <td>{{ $report->goods->jumlah ?? 'Tidak ada data' }}</td>
                <td>{{ number_format($report->total_pemasukan ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
