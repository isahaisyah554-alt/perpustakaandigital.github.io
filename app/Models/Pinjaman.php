<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamen'; // Pakai nama tabel yang ada di database kamu

    protected $fillable = [
        'user_id',
        'book_id',
        'tgl_pinjam',
        'durasi',
        'status',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel books (Pastiin nama modelnya 'Book')
    public function buku()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
