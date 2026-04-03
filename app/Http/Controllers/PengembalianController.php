<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{

    public function kembalikanbuku(Request $request){
        return view ('pengembalian.kembalikanbuku');
    }

    public function pengembaliandone(Request $request){
        return view ('pengembalian.pengembaliandone');
    }

    public function pengembalianterlambat(Request $request){
        return view ('pengembalian.pengembalianterlambat');
    }

    public function doneterlambat(Request $request){
        return view ('pengembalian.doneterlambat');
    }
}
