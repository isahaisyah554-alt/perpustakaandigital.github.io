<?php

namespace App\Models;

// Baris Request yang salah tadi dihapus saja, tidak terpakai di sini
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini kalau mau pakai Factory

class Book extends Model
{
    use HasFactory; // Opsional, standar Laravel
        protected $fillable = [
    'foto',
    'judul',
    'penulis',
    'tahun_terbit', // Wajib ada di sini!
    'stok_buku'
    ];
}
