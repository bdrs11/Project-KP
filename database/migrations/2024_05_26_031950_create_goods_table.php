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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 255);
            $table->decimal('harga', 12, 2);
            $table->string('ukuran', 255)->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_ditambahkan');
            $table->date('tanggal_masuk')->nullable();
            $table->foreignId('categoriesid')->constrained('categories')->onDelete('cascade')->default(1);
            $table->foreignId('supplierid')->constrained('suppliers')->onDelete('cascade');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};