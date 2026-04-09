<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';

        protected $fillable =
        [
            'user_id',
            'book_id',
            'tgl_pinjam',
            'tgl_kembali',
            'durasi',
            'status',
            'denda',
        ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel books (Pastiin nama modelnya 'Book')
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
