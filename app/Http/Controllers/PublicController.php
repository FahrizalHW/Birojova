<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function landing()
    {
        $layanans = Layanan::all();
        return view('landing', compact('layanans'));
    }
}

