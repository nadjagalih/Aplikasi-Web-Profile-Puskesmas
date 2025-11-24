<?php

namespace App\Http\Controllers;

use App\Models\AlurPelayanan;
use Illuminate\Http\Request;
use App\Helpers\HtmlSanitizer;

class AdminAlurPelayananController extends Controller
{
    public function index()
    {
        // Get or create single alur pelayanan record
        $alurPelayanan = AlurPelayanan::first();
        
        return view('admin.alur-pelayanan.index', compact('alurPelayanan'));
    }

    public function create()
    {
        // Redirect to index as we only need one record
        return redirect()->route('alur-pelayanan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'deskripsi' => 'nullable|string',
        ], [
            'status.required' => 'Status wajib dipilih!',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 5MB'
        ]);

        try {
            // Check if record already exists
            $alurPelayanan = AlurPelayanan::first();
            
            if ($alurPelayanan) {
                // Update existing record
                if ($request->hasFile('gambar')) {
                    // Delete old image if exists and path is valid
                    if ($alurPelayanan->gambar) {
                        $oldPath = public_path('storage/' . $alurPelayanan->gambar);
                        if (file_exists($oldPath) && is_file($oldPath)) {
                            unlink($oldPath);
                        }
                    }

                    $gambar = $request->file('gambar');
                    $gambarName = time() . '_alur_pelayanan.' . $gambar->getClientOriginalExtension();
                    $gambar->move(public_path('storage/alur-pelayanan'), $gambarName);
                    
                    $alurPelayanan->update([
                        'gambar' => 'alur-pelayanan/' . $gambarName,
                        'deskripsi' => HtmlSanitizer::sanitize($request->deskripsi)
                    ]);
                } else {
                    // Update deskripsi saja
                    $alurPelayanan->update([
                        'deskripsi' => HtmlSanitizer::sanitize($request->deskripsi)
                    ]);
                }
            } else {
                // Create new record
                if ($request->hasFile('gambar')) {
                    $gambar = $request->file('gambar');
                    $gambarName = time() . '_alur_pelayanan.' . $gambar->getClientOriginalExtension();
                    $gambar->move(public_path('storage/alur-pelayanan'), $gambarName);
                    
                    AlurPelayanan::create([
                        'gambar' => 'alur-pelayanan/' . $gambarName,
                        'judul' => 'Alur Pelayanan Puskesmas',
                        'deskripsi' => HtmlSanitizer::sanitize($request->deskripsi),
                        'urutan' => 1,
                        'status' => 'Aktif'
                    ]);
                }
            }

            return redirect()->route('alur-pelayanan.index')->with('success', 'Gambar alur pelayanan berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate gambar: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(AlurPelayanan $alurPelayanan)
    {
        // Redirect to index as we only edit from index page
        return redirect()->route('alur-pelayanan.index');
    }

    public function update(Request $request, AlurPelayanan $alurPelayanan)
    {
        // This method is not used anymore, handled by store
        return redirect()->route('alur-pelayanan.index');
    }

    public function destroy(AlurPelayanan $alurPelayanan)
    {
        try {
            // Delete image if exists
            if ($alurPelayanan->gambar) {
                $imagePath = public_path('storage/' . $alurPelayanan->gambar);
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }

            $alurPelayanan->delete();

            return redirect()->route('alur-pelayanan.index')->with('success', 'Gambar alur pelayanan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}
