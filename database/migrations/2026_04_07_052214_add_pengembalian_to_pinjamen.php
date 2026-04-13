<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dateTime('tgl_kembali')->nullable()->after('durasi');

            $table->integer('denda')->default(0)->after('tgl_kembali');
        });
    }

    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dropColumn(['tgl_kembali', 'denda']);
        });
    }
};
