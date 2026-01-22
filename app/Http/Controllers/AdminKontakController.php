<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminKontakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.kontak.index', [
            'kontak'    => Kontak::first()
        ]);
    }

    public function update(Request $request, $id)
    {
        $kontak = Kontak::find($id);
        $validator = Validator::make($request->all(), [
            'lokasi'        => 'required',
            'email'         => 'required|email:rfc,dns',
            'no_hp'         => 'required',
            'map_url'       => 'nullable|string',
            'instagram_url' => 'nullable|string'
        ], [
            'lokasi.required'   => 'Wajib menambahkan lokasi desa !',
            'email.required'    => 'Wajib menambahkan email desa !',
            'email.email'       => 'Format Email yang benar dibutuhkan !',
            'no_hp.required'    => 'Wajib menambahkan nomor hp !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kontak->update([
            'lokasi'        => $request->lokasi,
            'email'         => $request->email,
            'no_hp'         => $request->no_hp,
            'map_url'       => $request->map_url,
            'instagram_url' => $request->instagram_url,
        ]);

        return redirect()->back()->with('success', 'Berhasil memperbarui data kontak desa');
    }
}
