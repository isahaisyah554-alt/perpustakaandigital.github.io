<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DataBukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;

        $books = Book::when($search, function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                          ->orWhere('penulis', 'like', "%{$search}%")
                          ->orWhere('tahun_terbit', 'like', "%{$search}%")
                          ->orWhere('id', 'like', "%{$search}%");
                })
                ->latest()
                ->get();

        return view('kepala.databuku', compact('books'));
    }
}
