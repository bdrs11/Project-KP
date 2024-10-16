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
        Schema::create('report_sales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_transaksi');
            $table->integer('pemasukan');
            $table->string('keterangan', 255);
            $table->foreignId('saleid')->constrained('sales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_sales');
    }
};
