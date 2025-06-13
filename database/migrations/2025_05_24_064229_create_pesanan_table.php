<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_pesanan')->unique();
            $table->string('nama_pembeli');
            $table->unsignedBigInteger('produk_id');
            $table->string('status');
            $table->integer('jumlah');
            $table->decimal('harga', 12, 2);
            $table->decimal('jumlah_harga', 14, 2);
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
