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
        $table->foreignId('user_id');
        $table->foreignId('book_id');
        $table->date('tgl_pinjam');
        $table->integer('durasi');
        $table->string('status')->default('menunggu');
        $table->dateTime('tgl_kembali')->nullable(); // <-- TAMBAHKAN INI
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            //
        });
    }
};
