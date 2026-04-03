<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        return view ('dashboard.dashboard');
    }

    public function petugas(Request $request){
        return view ('dashboard.petugas');
    }

    public function kepalaperpustakaan(Request $request){
        return view ('dashboard.kepalaperpustakaan');
    }

}
