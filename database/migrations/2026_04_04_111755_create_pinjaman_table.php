<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('pinjamen', function (Blueprint $table) {
        $table->id();

        // relasi
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('book_id');

        // data peminjaman
        $table->date('tgl_pinjam');
        $table->integer('durasi');

        // status
        $table->string('status')->default('menunggu');

        $table->timestamps();
    });
}
};
