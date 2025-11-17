<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::latest()->get();
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tempat' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'warna' => 'nullable|string',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
        ], [
            'judul.required' => 'Judul agenda wajib diisi!',
            'deskripsi.required' => 'Deskripsi agenda wajib diisi!',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi!',
            'status.required' => 'Status wajib dipilih!',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['warna'] = $request->warna ?? '#FFD700'; // Default kuning

        Agenda::create($validated);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tempat' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'warna' => 'nullable|string',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
        ], [
            'judul.required' => 'Judul agenda wajib diisi!',
            'deskripsi.required' => 'Deskripsi agenda wajib diisi!',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi!',
            'status.required' => 'Status wajib dipilih!',
        ]);

        $validated['warna'] = $request->warna ?? '#FFD700'; // Default kuning
        $agenda->update($validated);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
