<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminSliderController extends Controller
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
        return view('admin.slider.index', [
            'sliders'   => Slider::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img_slider' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link_btn'   => 'nullable|string|max:255'
        ], [
            'img_slider.required' => 'Wajib tambahkan gambar untuk slider !',
            'img_slider.image'    => 'File harus berupa gambar !',
            'img_slider.mimes'    => 'Gunakan format gambar jpeg, jpg, png !',
            'img_slider.max'      => 'Ukuran gambar maksimal 2MB !',
            'link_btn.max'        => 'URL terlalu panjang (maksimal 255 karakter) !',
        ]);

        if ($validator->fails()) {
            return redirect("/admin/slider/create")
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('img_slider')){
            try {
                $file       = $request->file('img_slider');
                $extension  = $file->getClientOriginalExtension(); 
                $fileName   = uniqid() . '.' . $extension;
                
                // Simpan ke storage/app/public/img-slider
                $destinationPath = storage_path('app/public/img-slider');
                $file->move($destinationPath, $fileName);
                
                $img_slider = 'img-slider/' . $fileName;
            } catch (\Exception $e) {
                return redirect("/admin/slider/create")
                    ->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())
                    ->withInput();
            }
        } else {
            return redirect("/admin/slider/create")
                ->with('error', 'File gambar tidak ditemukan')
                ->withInput();
        }

        Slider::create([
            'link_btn'   => $request->link_btn,
            'img_slider' => $img_slider,
            'user_id'    => auth()->user()->id
        ]);

        return redirect('/admin/slider')->with('success', 'Berhasil menambahkan slider baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', [
            'slider'    => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $rules = [
            'img_slider' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'link_btn'   => 'nullable|string|max:255'
        ];

        $messages = [
            'img_slider.image' => 'File harus berupa gambar !',
            'img_slider.mimes' => 'Gunakan format gambar jpeg, jpg, png !',
            'img_slider.max'   => 'Ukuran gambar maksimal 2MB !',
            'link_btn.max'     => 'URL terlalu panjang (maksimal 255 karakter) !',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("/admin/slider/{$slider->id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $img_slider = $slider->img_slider;

        if($request->hasFile('img_slider')){
            try {
                // Hapus gambar lama jika ada
                if($slider->img_slider){
                    $oldImagePath = storage_path('app/public/' . $slider->img_slider);
                    if(file_exists($oldImagePath)){
                        unlink($oldImagePath);
                    }
                }

                $file       = $request->file('img_slider');
                $extension  = $file->getClientOriginalExtension(); 
                $fileName   = uniqid() . '.' . $extension;
                
                // Simpan ke storage/app/public/img-slider
                $destinationPath = storage_path('app/public/img-slider');
                $file->move($destinationPath, $fileName);
                
                $img_slider = 'img-slider/' . $fileName;
            } catch (\Exception $e) {
                return redirect("/admin/slider/{$slider->id}/edit")
                    ->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())
                    ->withInput();
            }
        }

        $slider->update([
            'link_btn'   => $request->link_btn,
            'img_slider' => $img_slider,
            'user_id'    => auth()->user()->id
        ]);

        return redirect('/admin/slider')->with('success', 'Berhasil memperbarui slider');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Hapus gambar dari storage/app/public
        if($slider->img_slider){
            $imagePath = storage_path('app/public/' . $slider->img_slider);
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }

        $slider->delete();

        return redirect('/admin/slider')->with('success', 'Berhasil menghapus slider');
    }
}
