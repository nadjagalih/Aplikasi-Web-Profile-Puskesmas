<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Berita;
use App\Models\Sambutan;
use App\Models\Layanan;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\SkmConfig;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil sambutan kepala puskesmas yang aktif
        $sambutan = Sambutan::where('status', 'Aktif')->first();
        
        // Ambil data SKM dari API
        $skm = null;
        
        // Ambil konfigurasi SKM dari database
        $config = SkmConfig::first();
        
        if ($config && $config->api_url) {
            try {
                $response = Http::timeout(10)->get($config->api_url);
                
                if ($response->successful()) {
                    $apiData = $response->json();
                    // Perbaikan: gunakan 'results' bukan 'data'
                    if (isset($apiData['results'])) {
                        $data = $apiData['results'];
                        $skm = [
                            'unit_kerja' => $data['unit_kerja'] ?? 'N/A',
                            'total_skor' => $data['total_skor'] ?? 0,
                            'grade' => $data['grade'] ?? 'N/A',
                            'keterangan' => $data['keterangan'] ?? 'N/A',
                            'periode_survey' => $data['periode_survey'] ?? 'N/A',
                            'total_responden' => $data['total_responden'] ?? 0,
                            // Perbaikan: langsung ambil jk_pria dan jk_wanita
                            'jk_pria' => $data['jk_pria'] ?? 0,
                            'jk_wanita' => $data['jk_wanita'] ?? 0,
                            'pendidikan' => $data['pendidikan'] ?? [],
                            'pekerjaan' => $data['pekerjaan'] ?? [],
                            'usia' => $data['usia'] ?? [],
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Jika gagal mengambil data dari API, set null
                $skm = null;
            }
        }

        return view('index', [
            'sliders'     => Slider::all(),
            'beritas'     => Berita::where('status_id', 2)->latest()->take(3)->get(),
            'sambutan'    => $sambutan,
            'skm'         => $skm,
            'layanans'    => Layanan::latest()->get(),
            'agendas'     => Agenda::where('status', 'Aktif')->latest()->take(3)->get(),
            'galleries'   => Gallery::latest()->take(9)->get() // Ambil 9 untuk 3 slide (3x3)
        ]);
    }
}
