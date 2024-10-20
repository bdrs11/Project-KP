<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_penjualan')->useCurrent();
            $table->string('nama_barang', 255);
            $table->string('ukuran', 255)->nullable();
            $table->integer('jumlah_barang');
            $table->decimal('harga_satuan', 19, 0);
            $table->decimal('total_harga', 19, 0);
            $table->decimal('jumlah_uang', 19, 0);  // Tambahkan kolom jumlah uang
            $table->decimal('kembalian', 19, 0);    // Tambahkan kolom kembalian
            $table->foreignId('goodid')->constrained('goods');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};