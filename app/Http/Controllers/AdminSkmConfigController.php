<?php

namespace App\Http\Controllers;

use App\Models\SkmConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminSkmConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display and edit the configuration.
     */
    public function index()
    {
        $config = SkmConfig::first();
        return view('admin.skm-config.index', compact('config'));
    }

    /**
     * Store or update the configuration.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_url' => 'required|url',
            'login_url' => 'required|url',
        ], [
            'api_url.required' => 'URL API SKM wajib diisi!',
            'api_url.url' => 'URL API SKM harus berupa URL yang valid!',
            'login_url.required' => 'URL Login SKM wajib diisi!',
            'login_url.url' => 'URL Login SKM harus berupa URL yang valid!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $config = SkmConfig::first();

        if ($config) {
            // Update existing config
            $config->update([
                'api_url' => $request->api_url,
                'login_url' => $request->login_url,
                'nama_puskesmas' => 'Puskesmas',
                'kode_organisasi' => '',
                'status' => 'Aktif'
            ]);
            $message = 'Konfigurasi SKM berhasil diperbarui';
        } else {
            // Create new config
            SkmConfig::create([
                'api_url' => $request->api_url,
                'login_url' => $request->login_url,
                'nama_puskesmas' => 'Puskesmas',
                'kode_organisasi' => '',
                'status' => 'Aktif',
                'keterangan' => null
            ]);
            $message = 'Konfigurasi SKM berhasil disimpan';
        }

        return redirect()->route('skm-config.index')
            ->with('success', $message);
    }

    /**
     * Not used - redirect to index
     */
    public function create()
    {
        return redirect()->route('skm-config.index');
    }

    /**
     * Not used - redirect to index
     */
    public function edit(string $id)
    {
        return redirect()->route('skm-config.index');
    }

    /**
     * Not used - redirect to index
     */
    public function update(Request $request, string $id)
    {
        return $this->store($request);
    }

    /**
     * Not used - prevent deletion
     */
    public function destroy(string $id)
    {
        return redirect()->route('skm-config.index')
            ->with('error', 'Konfigurasi tidak dapat dihapus');
    }
}
