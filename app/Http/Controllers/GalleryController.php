<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Halaman daftar galeri
    public function index()
    {
        return view('gallery.index', [
            'galerrys'  => Gallery::orderBy('id', 'DESC')->paginate(12)
        ]);
    }

    // Halaman detail galeri
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.detail', compact('gallery'));
    }
}
