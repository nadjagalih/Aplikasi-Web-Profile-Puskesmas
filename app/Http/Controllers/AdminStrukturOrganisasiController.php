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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.struktur-organisasi.index', [
            'strukturOrganisasi'   => StrukturOrganisasi::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'jabatan'   => 'required',
            'foto'      => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [

            'nama.required'     => 'Wajib menambahkan nama struktur organisasi !',
            'jabatan.required'  => 'Wajib menambahkan jabatan struktur organisasi !',
            'foto.required'     => 'Wajib menambahkan foto struktur organisasi !',
            'foto.image'        => 'File harus berupa gambar !',
            'foto.mimes'        => 'Format gambar yang di izinkan Jpeg, Jpg, Png',
            'foto.max'          => 'Ukuran gambar maksimal 2MB !',
        ]);

        // CEK VALIDASI DULU SEBELUM UPLOAD
        if($validator->fails()){
            return redirect('/admin/struktur-organisasi/create')
                ->withErrors($validator)
                ->withInput();
        }

        // BARU UPLOAD FILE SETELAH VALIDASI LOLOS
        if($request->hasFile('foto')){
            $path       = 'img-struktur-organisasi/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            
            // Pastikan direktori ada
            if (!file_exists(public_path('storage/' . $path))) {
                mkdir(public_path('storage/' . $path), 0755, true);
            }
            
            $file->move(public_path('storage/' . $path), $fileName);
            $foto       = $path . $fileName;
        } else {
            $foto       = null;
        }

        $strukturOrganisasi = StrukturOrganisasi::create([
            'nama'      => $request->nama,
            'jabatan'   => $request->jabatan,
            'foto'      => $foto,
            'user_id'   => Auth::id()
        ]);

        return redirect('/admin/struktur-organisasi')->with('success', 'Berhasil menambahkan data struktur organisasi');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        return view('admin.struktur-organisasi.edit', [
            'strukturOrganisasi'     => $strukturOrganisasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'jabatan'   => 'required',
        ], [

            'nama.required'     => 'Wajib menambahkan nama struktur organisasi !',
            'jabatan.required'  => 'Wajib menambahkan jabatan struktur organisasi !',
        ]);

        if($request->hasFile('foto')){
            // Hapus foto lama jika ada
            if($strukturOrganisasi->foto && file_exists(public_path('storage/' . $strukturOrganisasi->foto))){
                unlink(public_path('storage/' . $strukturOrganisasi->foto));
            }
            $path       = 'img-struktur-organisasi/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension(); 
            $fileName   = uniqid() . '.' . $extension;
            $file->move(public_path('storage/' . $path), $fileName);
            $foto       = $path . $fileName;
        } else {
            $validator = Validator::make($request->all(), [
                'nama'      => 'required',
                'jabatan'   => 'required',
            ], [

                'nama.required'     => 'Wajib menambahkan nama struktur organisasi !',
                'jabatan.required'  => 'Wajib menambahkan jabatan struktur organisasi !',
            ]);
            $foto = $strukturOrganisasi->foto;
        }

        if ($validator->fails()) {
            return redirect("/admin/struktur-organisasi/{$strukturOrganisasi->id}/edit")
                ->withErrors($validator)
                ->withInput();
        };

        $strukturOrganisasi->update([
            'nama'      => $request->nama,
            'jabatan'   => $request->jabatan,
            'foto'      => $foto,
            'user_id'   => Auth::id()
        ]);

        return redirect('/admin/struktur-organisasi')->with('success', 'Berhasil memperbarui data struktur organisasi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        // Cek apakah file foto ada sebelum menghapus
        if($strukturOrganisasi->foto && file_exists(public_path('storage/' . $strukturOrganisasi->foto))){
            unlink(public_path('storage/' . $strukturOrganisasi->foto));
        }

        $strukturOrganisasi->delete();

        return redirect('/admin/struktur-organisasi')->with('success', 'Berhasil menghapus data struktur organisasi');
    }
}
