<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DataBukuController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();
        return view('kepala.databuku', compact('books'));
    }
}
