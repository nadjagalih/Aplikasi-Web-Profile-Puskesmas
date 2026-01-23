<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Halaman daftar album
    public function index()
    {
        return view('gallery.index', [
            'albums'  => Album::orderBy('id', 'DESC')->paginate(12)
        ]);
    }

    // Halaman detail album dengan semua gambar
    public function show($id)
    {
        $album = Album::with('images')->findOrFail($id);
        return view('gallery.detail', compact('album'));
    }
}
