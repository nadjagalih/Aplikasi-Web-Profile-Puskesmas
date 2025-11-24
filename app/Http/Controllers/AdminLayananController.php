<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\HtmlSanitizer;

class AdminLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layanan.index', [
            'layanans'  => Layanan::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan'  => 'required|string|max:255',
            'deskripsi'     => 'required',
            'persyaratan'   => 'nullable',
            'biaya'         => 'nullable|string|max:255',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status'        => 'required|in:Tersedia,Tidak Tersedia'
        ], [
            'nama_layanan.required'  => 'Nama layanan wajib diisi!',
            'deskripsi.required'     => 'Deskripsi wajib diisi!',
            'status.required'        => 'Status wajib dipilih!',
            'gambar.image'           => 'File harus berupa gambar!',
            'gambar.mimes'           => 'Format gambar harus jpeg, png, atau jpg!',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'nama_layanan'  => $request->nama_layanan,
            'slug'          => Str::slug($request->nama_layanan),
            'deskripsi'     => HtmlSanitizer::sanitize($request->deskripsi),
            'persyaratan'   => HtmlSanitizer::sanitize($request->persyaratan),
            'biaya'         => $request->biaya,
            'status'        => $request->status
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            
            // Simpan ke storage/app/public/layanan
            $gambar->move(storage_path('app/public/layanan'), $gambarName);
            $data['gambar'] = 'layanan/' . $gambarName;
        }

        Layanan::create($data);

        return redirect('/admin/layanan')->with('success', 'Berhasil menambahkan informasi layanan baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = Layanan::find($id);
        return view('admin.layanan.edit', [
            'layanan' => $layanan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::find($id);
        
        $validator = Validator::make($request->all(), [
            'nama_layanan'  => 'required|string|max:255',
            'deskripsi'     => 'required',
            'persyaratan'   => 'nullable',
            'biaya'         => 'nullable|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'        => 'required|in:Tersedia,Tidak Tersedia'
        ], [
            'nama_layanan.required'  => 'Nama layanan wajib diisi!',
            'deskripsi.required'     => 'Deskripsi wajib diisi!',
            'status.required'        => 'Status wajib dipilih!',
            'gambar.image'           => 'File harus berupa gambar!',
            'gambar.mimes'           => 'Format gambar harus jpeg, png, atau jpg!',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'nama_layanan'  => $request->nama_layanan,
            'slug'          => Str::slug($request->nama_layanan),
            'deskripsi'     => HtmlSanitizer::sanitize($request->deskripsi),
            'persyaratan'   => HtmlSanitizer::sanitize($request->persyaratan),
            'biaya'         => $request->biaya,
            'status'        => $request->status
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar))) {
                unlink(storage_path('app/public/' . $layanan->gambar));
            }
            
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            
            // Simpan ke storage/app/public/layanan
            $gambar->move(storage_path('app/public/layanan'), $gambarName);
            $data['gambar'] = 'layanan/' . $gambarName;
        }

        $layanan->update($data);

        return redirect('/admin/layanan')->with('success', 'Berhasil memperbarui data informasi layanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::find($id);
        
        // Delete image if exists
        if ($layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar))) {
            unlink(storage_path('app/public/' . $layanan->gambar));
        }
        
        $layanan->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}