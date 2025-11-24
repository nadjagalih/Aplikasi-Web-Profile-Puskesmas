<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\HtmlSanitizer;

class AdminProfilPkmController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        return view('admin.profilpkm.index', [
            'profil'   => $profil
        ]);
    }

    public function edit($id)
    {
        $profil = Profil::find($id);
        return view('admin.profilpkm.edit', [
            'profil'   => $profil
        ]);
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::find($id);
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'body'      => 'required'
        ], [
            'judul.required'   => 'Form judul tidak boleh kosong !',
            'body.required'    => 'Deskripsi wilayah desa wajib di isi !'
        ]);

        if($validator->fails()){
            return redirect("/admin/profilpkm/{$profil->id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $profil->update([
            'judul'     => $request->judul,
            'body'      => HtmlSanitizer::sanitize($request->body),
        ]);

        return redirect('/admin/profilpkm')->with('success', 'Berhasil memperbarui data profil desa');
    }
}
