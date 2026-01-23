<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;

class AdminBerkasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $berkas = Berkas::orderBy('created_at', 'desc')->get();
        return view('admin.berkas.index', compact('berkas'));
    }

    public function create()
    {
        return view('admin.berkas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'status' => 'required|in:Aktif,Non-Aktif'
        ], [
            'judul.required' => 'Judul harus diisi',
            'file.required' => 'File harus diupload',
            'file.mimes' => 'Format file tidak didukung. Gunakan: PDF, Word, Excel, PowerPoint, ZIP, atau RAR',
            'file.max' => 'Ukuran file maksimal 10MB',
            'status.required' => 'Status harus dipilih'
        ]);

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Get file size BEFORE moving
                $fileSize = $this->formatFileSize($file->getSize());
                
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
                
                // Save to storage/app/public/berkas
                $file->move(storage_path('app/public/berkas'), $fileName);
                $filePath = 'berkas/' . $fileName;

                Berkas::create([
                    'judul' => $validated['judul'],
                    'deskripsi' => $validated['deskripsi'],
                    'kategori' => $validated['kategori'],
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'file_size' => $fileSize,
                    'status' => $validated['status'],
                    'download_count' => 0
                ]);
            }

            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan berkas: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $berkas = Berkas::findOrFail($id);
        return view('admin.berkas.edit', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $berkas = Berkas::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'status' => 'required|in:Aktif,Non-Aktif'
        ], [
            'judul.required' => 'Judul harus diisi',
            'file.mimes' => 'Format file tidak didukung. Gunakan: PDF, Word, Excel, PowerPoint, ZIP, atau RAR',
            'file.max' => 'Ukuran file maksimal 10MB',
            'status.required' => 'Status harus dipilih'
        ]);

        try {
            if ($request->hasFile('file')) {
                // Delete old file
                $oldFilePath = storage_path('app/public/' . $berkas->file_path);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                $file = $request->file('file');
                
                // Get file size BEFORE moving
                $fileSize = $this->formatFileSize($file->getSize());
                
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
                
                // Save to storage/app/public/berkas
                $file->move(storage_path('app/public/berkas'), $fileName);
                $filePath = 'berkas/' . $fileName;

                $validated['file_path'] = $filePath;
                $validated['file_name'] = $fileName;
                $validated['file_size'] = $fileSize;
            }

            $berkas->update($validated);

            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate berkas: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $berkas = Berkas::findOrFail($id);

            // Delete file
            $filePath = storage_path('app/public/' . $berkas->file_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $berkas->delete();

            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus berkas: ' . $e->getMessage());
        }
    }

    public function preview($id)
    {
        $berkas = Berkas::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $berkas->file_path);
        
        if (file_exists($filePath)) {
            $ext = pathinfo($berkas->file_name, PATHINFO_EXTENSION);
            
            // For PDF, open in browser
            if (strtolower($ext) === 'pdf') {
                return response()->file($filePath);
            }
            
            // For other files, download
            return response()->download($filePath, $berkas->file_name);
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
