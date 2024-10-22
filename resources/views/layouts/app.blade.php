<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'kopsis') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Custom CSS -->
        <style>
            .navbar-bg-black {
              position: fixed;
              top: 0;
              left: 0;
              height: 100vh;
              width: 280px;
              background-color: rgb(37, 8, 135) !important;
              z-index: 1000;
            }
            .nav-link.text-black {
                color: white !important;
            }
            
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div id="app" class="d-flex">
            <div class="d-flex flex-column flex-shrink-0 p-3 py-3 navbar-bg-black" style="width: 280px; height :100vh">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                  <img src="{{ asset('logo-sekolah.png') }}" alt="Logo Sekolah" />
                  <span class="fs-4 px-2 py-1">KOPSIS</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto p-3 py-5">
                  <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.dashboard")
                      Dashboard
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.admin.kelola_barang') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.barang")
                      Kelola Barang
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.admin.kelola_stock') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.stock")
                      Penerimaan Barang
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.admin.suppliers') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.supplier")
                      Kelola Supplier
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.admin.penjualan') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.penjualan")
                      Penjualan
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.admin.laporan_keuangan') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.keuangan")
                      Laporan Transaksi
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.pengguna.laporan') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.laporan")
                      Laporan Stock
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('koperasi.pengguna.anggota') }}" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                        @include("icons.anggota")
                      Anggota
                    </a>
                  </li>
                </ul>
                <hr>
             </div>

            <div class="w-full bg-gray-100">
                @include('layouts.navigation')
               
                <!-- Page Heading -->
                @if (isset($header))
                <header class="bg-white shadow" style="margin-left: 260px; padding: 20px; max-width: 1200px; width: 80%; margin-right: auto;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
               @endif
    
                <!-- Page Content -->
                <div class="main-content bg-gray-100" style="margin-left: 260px; padding: 20px; overflow-y: auto; max-width: 1200px; width: 80%; margin-right: auto;">
                  <!-- Page Content -->
                  <main>
                      {{ $slot }}
                  </main>
               </div>
              
            </div>
        </div>
    </body>
</html>
