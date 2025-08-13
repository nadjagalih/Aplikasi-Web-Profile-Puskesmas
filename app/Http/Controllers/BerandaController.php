<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Berita;
use App\Models\VideoProfil;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil data dari API SKM
        $skm = null;
        try {
            $response = Http::get('https://skm.trenggalekkab.go.id/api/survey-organisasi/NDYwMDAwMDAwMA');
            if ($response->successful()) {
                $skm = $response->json()['results'];
            }
        } catch (\Exception $e) {
            $skm = null;
        }

        return view('index', [
            'sliders'     => Slider::all(),
            'beritas'     => Berita::where('status_id', 2)->latest()->take(3)->get(),
            'videoProfil' => VideoProfil::first(),
            'skm'         => $skm
        ]);
    }
}
