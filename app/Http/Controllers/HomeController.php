<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today('Asia/Jakarta');
        $query = Berita::whereDate('updated_at', $today)->get();
        $viewsToday = $query->sum('views');

        $totalBerita    = Berita::count();
        $beritas        = Berita::orderBy('created_at', 'DESC')->take(10)->get();

        return view('admin.dashboard', [
            'totalBerita'    => $totalBerita,
            'viewsToday'     => $viewsToday,
            'beritas'        => $beritas
        ]);
    }
}
