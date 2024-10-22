<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi - Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background-color: #003A78;
            color: white;
            padding: 20px 0;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .btn-green {
            background-color: #4CAF50;
            color: white;
        }
        .btn-green:hover {
            background-color: #45a049;
        }
        .pos-img {
            max-width: 100%;
            height: auto;
        }
        .logo {
            width: 45px; /* Atur ukuran logo sesuai kebutuhan */
            margin-right: 10px; /* Spasi antara logo dan teks */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('logo-sekolah.png') }}" alt="Logo Sekolah" class="logo">
                <span class="font-weight-bold">KOPSIS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Daftar Barang</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary" href="{{ route('login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1>Daftar Barang</h1>
        </div>
    </div>
                <!-- Tabel Daftar Barang -->
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga (Rp)</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Jumlah Stock</th>
                        <th scope="col">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num=1; @endphp
                    @foreach($goods as $good)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $good->nama_barang }}</td>
                        <td>{{ number_format($good->harga, 0, ',', '.') }}</td>
                        <td>{{ $good->ukuran }}</td>
                        <td>{{ $good->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($good->tanggal_ditambahkan)->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-3 text-center mt-5">
        <div class="container">
            <p>© 2024 Badrussalam. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
