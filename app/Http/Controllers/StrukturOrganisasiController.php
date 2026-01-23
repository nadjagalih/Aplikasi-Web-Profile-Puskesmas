<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $gambarStruktur = StrukturOrganisasi::first();
        
        return view('struktur-organisasi.index', [
            'gambarStruktur' => $gambarStruktur
        ]);
    }
}
