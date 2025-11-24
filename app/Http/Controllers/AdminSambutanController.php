<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sambutan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\HtmlSanitizer;

class AdminSambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sambutan.index', [
            'sambutan' => Sambutan::first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        return view('admin.sambutan.edit', [
            'sambutan' => $sambutan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sambutan = Sambutan::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama' => 'required',
            'isi_sambutan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'jabatan.required' => 'Wajib mengisi jabatan!',
            'nama.required' => 'Wajib mengisi nama!',
            'isi_sambutan.required' => 'Wajib mengisi isi sambutan!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format gambar yang diizinkan: Jpeg, Jpg, Png',
            'foto.max' => 'Ukuran gambar maksimal 2MB!'
        ]);

        if($validator->fails()){
            return redirect("/admin/sambutan/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $fotoPath = $sambutan->foto;
        if($request->hasFile('foto')){
            // Delete old foto if exists
            if($sambutan->foto && file_exists(storage_path('app/public/' . $sambutan->foto))){
                unlink(storage_path('app/public/' . $sambutan->foto));
            }
            
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke storage/app/public/sambutan
            $file->move(storage_path('app/public/sambutan'), $fileName);
            $fotoPath = 'sambutan/' . $fileName;
        }

        $sambutan->update([
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'isi_sambutan' => HtmlSanitizer::sanitize($request->isi_sambutan),
            'foto' => $fotoPath,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'status' => $request->status ?? 'Aktif',
            'user_id' => Auth::id()
        ]);

        return redirect('/admin/sambutan')->with('success', 'Berhasil memperbarui sambutan');
    }

}
