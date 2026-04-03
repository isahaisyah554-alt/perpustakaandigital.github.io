<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Request;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
    'foto',
    'judul',
    'penulis',
    'stok_buku'
];
}
