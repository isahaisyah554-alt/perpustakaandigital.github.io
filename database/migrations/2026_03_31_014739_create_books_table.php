<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable(); // Tambah nullable() agar tidak error jika foto kosong
            $table->string('judul');
            $table->string('penulis');
            $table->integer('tahun_terbit'); // Tambahkan kolom ini di sini
            $table->integer('stok_buku');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};


