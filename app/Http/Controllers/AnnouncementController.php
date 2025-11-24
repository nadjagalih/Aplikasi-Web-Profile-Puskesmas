<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('/pengumuman.index', [
            'pengumumans'   => Announcement::orderBy('id', 'DESC')->paginate(9)
        ]);
    }

    public function detail($slug)
    {
        $pengumuman = Announcement::where('slug', $slug)->with('user')
            ->orderBy('id', 'DESC')
            ->first();
        
        // Null check to prevent error exposure
        if (!$pengumuman) {
            abort(404);
        }
        
        $pengumuman->views += 1;
        $pengumuman->save();

        return view('pengumuman.detail', [
            'pengumuman'    => $pengumuman
        ]);
    }
}
