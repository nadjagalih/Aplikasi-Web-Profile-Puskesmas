<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SurveyOrganisasiController extends Controller
{
    public function index()
    {
        $response = Http::get('https://skm.trenggalekkab.go.id/api/survey-organisasi/NDYwMDAwMDAwMA');

        if ($response->successful()) {
            $data = $response->json();
            return view('survey.index', ['survey' => $data]);
        } else {
            return view('survey.index', ['survey' => null, 'error' => 'Gagal mengambil data survey.']);
        }
    }
}
