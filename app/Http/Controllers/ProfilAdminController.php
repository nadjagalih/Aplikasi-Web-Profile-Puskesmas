<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilAdminController extends Controller
{
    public function index()
    {
        return view('admin.profil.index', [
            'profil'    => User::first()
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        // Validasi - semua field nullable, validasi hanya di frontend
        $validator = Validator::make($request->all(), [
            'name'       => 'nullable',
            'username'   => 'nullable|unique:users,username,' . $id,
            'email'      => 'nullable|email:rfc,dns',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'username.unique'    => 'Username sudah digunakan !',
            'email.email'        => 'Gunakan email yang sah !',
            'foto.image'         => 'File harus berupa gambar !',
            'foto.mimes'         => 'Format gambar harus jpeg, png, jpg, atau gif !',
            'foto.max'           => 'Ukuran gambar maksimal 2MB !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Handle upload foto
        if($request->hasFile('foto')){
            // Hapus foto lama jika ada
            if($user->foto && Storage::disk('public')->exists($user->foto)){
                Storage::disk('public')->delete($user->foto);
            }
            $path       = 'img-profil/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension(); 
            $fileName   = uniqid() . '.' . $extension; 
            $foto       = $file->storeAs($path, $fileName, 'public');
        } else {
            // Jika tidak upload foto baru, pakai foto lama
            $foto = $user->foto;
        }

        $user->update([
            'foto'     => $foto,
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        return redirect('/admin/profil')->with('success', 'Berhasil memperbarui profil');
    }

 
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'passwordNew'      => 'required|same:confirmPassword',
        ], [
            'current_password.required' => 'Masukkan Password saat ini !',
            'passwordNew.required'      => 'Masukkan Password baru !',
            'passwordNew.same'          => 'Password tidak sama'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withOnly(['passwordNew', 'confirmPassword']);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password lama salah !'])
                ->withOnly(['passwordNew', 'confirmPassword']);
        } else {
            User::whereId($user->id)->update([
                'password' => Hash::make($request->passwordNew)
            ]);
            
            Auth::logout();

            return redirect()->route('login') 
                ->with('password-success', 'Berhasil Memperbarui Password. Silakan masuk kembali dengan password baru.');
        }
    }

    
}
