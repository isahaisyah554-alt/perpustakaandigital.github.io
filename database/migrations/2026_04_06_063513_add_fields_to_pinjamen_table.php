<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('pinjamen', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable();
        $table->unsignedBigInteger('book_id')->nullable();
        $table->date('tgl_pinjam')->nullable();
        $table->string('status')->default('menunggu');
    });
}
    public function down(): void
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            //
        });
    }
};
