<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    public function caribuku(Request $request){
        return view ('peminjaman.caribuku');
    }

    public function peminjamanbuku(Request $request){
        return view ('peminjaman.peminjamanbuku');
    }

    public function pinjamansukses (Request $request){
        return view ('peminjaman.pinjamansukses');
    }

    public function pinjamansaya (Request $request){
        return view ('peminjaman.pinjamansaya');
    }

    public function riwayatpinjaman (Request $request){
        return view ('peminjaman.riwayatpinjaman');
    }
}
