<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.gallery.index', [
            'albums'  => Album::with('images')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'         => 'required|max:255',
            'deskripsi'     => 'nullable|max:1000',
            'cover_image'   => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'judul.required'         => 'Judul album wajib diisi!',
            'judul.max'              => 'Judul maksimal 255 karakter!',
            'deskripsi.max'          => 'Deskripsi maksimal 1000 karakter!',
            'cover_image.required'   => 'Foto sampul wajib diisi!',
            'cover_image.image'      => 'File harus berupa gambar!',
            'cover_image.mimes'      => 'Format yang diizinkan png, jpg, jpeg!',
            'cover_image.max'        => 'Ukuran file maksimal 5MB!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Upload cover image
        $coverImage = null;
        if ($request->hasFile('cover_image')) {
            $file       = $request->file('cover_image');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $file->move(storage_path('app/public/albums'), $fileName);
            $coverImage = 'albums/' . $fileName;
        }

        // Create album
        $album = Album::create([
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'cover_image'  => $coverImage,
            'user_id'      => auth()->user()->id,
        ]);

        return redirect('/admin/gallery/' . $album->id)->with('success', 'Album berhasil dibuat! Silakan tambahkan foto ke album.');
    }

    /**
     * Display the specified album detail.
     */
    public function show(string $id)
    {
        $album = Album::with('images')->findOrFail($id);
        return view('admin.gallery.show', [
            'album' => $album,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $album = Album::findOrFail($id);
        return view('admin.gallery.edit', [
            'album' => $album,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::find($id);
        
        $validator = Validator::make($request->all(), [
            'judul'         => 'required|max:255',
            'deskripsi'     => 'nullable|max:1000',
            'cover_image'   => 'nullable|image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'judul.required'         => 'Judul album wajib diisi!',
            'judul.max'              => 'Judul maksimal 255 karakter!',
            'deskripsi.max'          => 'Deskripsi maksimal 1000 karakter!',
            'cover_image.image'      => 'File harus berupa gambar!',
            'cover_image.mimes'      => 'Format yang diizinkan png, jpg, jpeg!',
            'cover_image.max'        => 'Ukuran file maksimal 5MB!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update cover image if new one uploaded
        $coverImage = $album->cover_image;
        if ($request->hasFile('cover_image')) {
            // Delete old cover image with path validation
            if ($album->cover_image) {
                $oldPath = $album->cover_image;
                if (strpos($oldPath, '..') === false && file_exists(storage_path('app/public/' . $oldPath))) {
                    @unlink(storage_path('app/public/' . $oldPath));
                }
            }
            
            $file       = $request->file('cover_image');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $file->move(storage_path('app/public/albums'), $fileName);
            $coverImage = 'albums/' . $fileName;
        }

        // Update album
        $album->update([
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'cover_image'  => $coverImage
        ]);

        return redirect('/admin/gallery/' . $album->id)->with('success', 'Berhasil memperbarui album');
    }

    /**
     * Store images to album.
     */
    public function storeImages(Request $request, string $id)
    {
        $album = Album::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'images.required' => 'Pilih minimal satu gambar!',
            'images.*.required' => 'File gambar wajib dipilih!',
            'images.*.image'    => 'File harus berupa gambar!',
            'images.*.mimes'    => 'Format gambar yang diizinkan: PNG, JPG, JPEG!',
            'images.*.max'      => 'Ukuran file maksimal 5MB (5120KB)!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $extension  = $image->getClientOriginalExtension();
                $fileName   = uniqid() . '.' . $extension;
                $image->move(storage_path('app/public/albums'), $fileName);
                
                AlbumImage::create([
                    'album_id'   => $album->id,
                    'gambar'     => 'albums/' . $fileName
                ]);
            }
        }

        return redirect('/admin/gallery/' . $album->id)->with('success', 'Berhasil menambahkan ' . count($request->file('images')) . ' foto ke album');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::with('images')->findOrFail($id);
        
        // Delete cover image with path validation
        if ($album->cover_image) {
            // Validate path to prevent directory traversal
            $coverPath = $album->cover_image;
            if (strpos($coverPath, '..') === false && file_exists(storage_path('app/public/' . $coverPath))) {
                @unlink(storage_path('app/public/' . $coverPath));
            }
        }
        
        // Delete all album images with path validation
        foreach ($album->images as $image) {
            if ($image->gambar) {
                // Validate path to prevent directory traversal
                $imagePath = $image->gambar;
                if (strpos($imagePath, '..') === false && file_exists(storage_path('app/public/' . $imagePath))) {
                    @unlink(storage_path('app/public/' . $imagePath));
                }
            }
        }
        
        $album->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus album');
    }
}
