<?php

namespace App\Http\Controllers;

use App\Models\Situs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminIdentitasSitusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.identitas-situs.index', [
            'situs' => Situs::first()
        ]);
    }

    public function update(Request $request, $id)
    {
        $situs = Situs::find($id);
        $validator = Validator::make($request->all(), [
            'nm_puskesmas'      => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'kode_pos'          => 'required',
        ], [
            'nm_puskesmas.required'      => 'Wajib menambahkan nama puskesmas !',
            'kecamatan.required'         => 'Wajib menambahkan kecamatan !',
            'kabupaten.required'         => 'Wajib menambahkan kabupaten !',
            'provinsi.required'          => 'Wajib menambahkan provinsi !',
            'kode_pos.required'          => 'Wajib menambahkan kode pos !'
        ]);

        if($request->hasFile('logo')){
            // Delete old logo if exists
            if($situs->logo && file_exists(public_path('storage/' . $situs->logo))){
                unlink(public_path('storage/' . $situs->logo));
            }
            $path       = 'img-logo/';
            $file       = $request->file('logo');
            $extension  = $file->getClientOriginalExtension(); 
            $fileName   = uniqid() . '.' . $extension;
            $file->move(public_path('storage/' . $path), $fileName);
            $logo       = $path . $fileName;
        } else {
            $validator = Validator::make($request->all(), [
                'nm_puskesmas'      => 'required',
                'kecamatan'         => 'required',
                'kabupaten'         => 'required',
                'provinsi'          => 'required',
                'kode_pos'          => 'required',
            ], [
                'nm_puskesmas.required'      => 'Wajib menambahkan nama puskesmas !',
                'kecamatan.required'         => 'Wajib menambahkan kecamatan !',
                'kabupaten.required'         => 'Wajib menambahkan kabupaten !',
                'provinsi.required'          => 'Wajib menambahkan provinsi !',
                'kode_pos.required'          => 'Wajib menambahkan kode pos !'
            ]);
            $logo = $situs->logo;
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $situs->update([
            'logo'              => $logo,
            'nm_puskesmas'      => $request->nm_puskesmas,
            'kecamatan'         => $request->kecamatan,
            'kabupaten'         => $request->kabupaten,
            'provinsi'          => $request->provinsi,
            'kode_pos'          => $request->kode_pos,
        ]);

        return redirect('/admin/identitas-situs')->with('success', 'Berhasil memperbarui identitas situs');
    }
}
