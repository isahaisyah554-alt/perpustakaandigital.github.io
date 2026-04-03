<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function anggota(Request $request){
        return view ('profile.anggota');
    }
}
