<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya khusus */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background-color: #003A78;
            color: white;
            padding: 60px 0;
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
                    <li class="nav-item"><a class="nav-link" href="/daftar_barang">Daftar Barang</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary" href="{{ route('login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1>Koperasi Sekolah SMP Suryacendikia</h1>
        </div>
        <!-- POS System Image Section -->
        <div class="container my-5 text-center">
            <!-- Menggunakan fungsi asset untuk path gambar -->
            <img src="{{ asset('koperasi.png') }}" alt="POS System" class="pos-img">
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-3 text-center">
        <div class="container">
            <p></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
