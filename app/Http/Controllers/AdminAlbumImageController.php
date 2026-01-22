<?php

namespace App\Http\Controllers;

use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAlbumImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified album image.
     */
    public function update(Request $request, $id)
    {
        $image = AlbumImage::findOrFail($id);
        
        $request->validate([
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'gambar.required' => 'Gambar wajib dipilih!',
            'gambar.image' => 'File harus berupa gambar!',
            'gambar.mimes' => 'Format yang diizinkan png, jpg, jpeg!',
            'gambar.max' => 'Ukuran file maksimal 5MB!'
        ]);
        
        // Update gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dengan validasi path
            if ($image->gambar) {
                $oldPath = $image->gambar;
                if (strpos($oldPath, '..') === false && file_exists(storage_path('app/public/' . $oldPath))) {
                    @unlink(storage_path('app/public/' . $oldPath));
                }
            }
            
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $file->move(storage_path('app/public/albums'), $fileName);
            
            $image->update(['gambar' => 'albums/' . $fileName]);
        }
        
        return redirect()->back()->with('success', 'Foto berhasil diperbarui');
    }

    /**
     * Remove the specified album image.
     */
    public function destroy($id)
    {
        $image = AlbumImage::findOrFail($id);
        
        // Delete image file from storage with path validation
        if ($image->gambar) {
            $imagePath = $image->gambar;
            // Prevent directory traversal attacks
            if (strpos($imagePath, '..') === false && file_exists(storage_path('app/public/' . $imagePath))) {
                @unlink(storage_path('app/public/' . $imagePath));
            }
        }
        
        $image->delete();
        
        return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
    }
}
