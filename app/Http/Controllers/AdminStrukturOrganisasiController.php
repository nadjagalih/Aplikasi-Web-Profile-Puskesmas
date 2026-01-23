<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminStrukturOrganisasiController extends Controller
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
        // Ambil gambar struktur organisasi (hanya 1 yang aktif)
        $gambarStruktur = StrukturOrganisasi::first();
        
        return view('admin.struktur-organisasi.index', [
            'gambarStruktur'       => $gambarStruktur
        ]);
    }
    
    /**
     * Upload gambar struktur organisasi
     */
    public function uploadGambarStruktur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar_struktur' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ], [
            'gambar_struktur.required' => 'Wajib menambahkan gambar struktur organisasi!',
            'gambar_struktur.image'    => 'File harus berupa gambar!',
            'gambar_struktur.mimes'    => 'Format gambar yang diizinkan: JPEG, JPG, PNG',
            'gambar_struktur.max'      => 'Ukuran gambar maksimal 5MB!',
        ]);

        if($validator->fails()){
            return redirect('/admin/struktur-organisasi')
                ->withErrors($validator)
                ->withInput();
        }

        // Hapus gambar struktur lama jika ada
        $gambarLama = StrukturOrganisasi::whereNotNull('gambar_struktur')->first();
        if($gambarLama && $gambarLama->gambar_struktur && file_exists(public_path('storage/' . $gambarLama->gambar_struktur))){
            unlink(public_path('storage/' . $gambarLama->gambar_struktur));
            $gambarLama->update(['gambar_struktur' => null]);
        }

        if($request->hasFile('gambar_struktur')){
            $path       = 'img-struktur-organisasi/';
            $file       = $request->file('gambar_struktur');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = 'struktur-' . time() . '.' . $extension;
            
            if (!file_exists(public_path('storage/' . $path))) {
                mkdir(public_path('storage/' . $path), 0755, true);
            }
            
            $file->move(public_path('storage/' . $path), $fileName);
            $gambarPath = $path . $fileName;
            
            // Simpan atau update gambar struktur
            if($gambarLama) {
                $gambarLama->update(['gambar_struktur' => $gambarPath]);
            } else {
                // Jika belum ada record, buat record untuk menyimpan gambar
                StrukturOrganisasi::create([
                    'gambar_struktur' => $gambarPath,
                    'user_id'         => Auth::id()
                ]);
            }
        }

        return redirect('/admin/struktur-organisasi')->with('success', 'Berhasil mengunggah gambar struktur organisasi');
    }
    
    /**
     * Hapus gambar struktur organisasi
     */
    public function hapusGambarStruktur()
    {
        $gambar = StrukturOrganisasi::whereNotNull('gambar_struktur')->first();
        
        if($gambar) {
            if($gambar->gambar_struktur && file_exists(public_path('storage/' . $gambar->gambar_struktur))){
                unlink(public_path('storage/' . $gambar->gambar_struktur));
            }
            
            // Hapus record
            $gambar->delete();
        }

        return redirect('/admin/struktur-organisasi')->with('success', 'Berhasil menghapus gambar struktur organisasi');
    }
}
