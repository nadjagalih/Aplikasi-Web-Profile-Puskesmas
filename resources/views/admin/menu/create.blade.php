@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
        <li class="breadcrumb-item active">Tambah Menu</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="ti ti-plus me-1"></i>
                    Form Tambah Menu
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Ada kesalahan dalam form:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('menu.store') }}" method="POST">
                        @csrf
                        
                        <!-- Hidden fields -->
                        <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
                        <input type="hidden" name="target" id="target" value="_self">
                        <input type="hidden" name="position" value="header">

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Menu <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="parent_only" {{ old('type', 'parent_only') == 'parent_only' ? 'selected' : '' }}>Parent Only</option>
                                <option value="parent_with_sub" {{ old('type') == 'parent_with_sub' ? 'selected' : '' }}>Parent with Sub</option>
                            </select>
                            <small class="text-muted">
                                Pilih "Parent with Sub" jika menu ini akan memiliki submenu
                            </small>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" 
                                   class="form-control @error('url') is-invalid @enderror" 
                                   id="url" 
                                   name="url" 
                                   value="{{ old('url') }}">
                            <small class="text-muted">
                                <span id="url-help-parent_only" style="display:none;">Internal: /nama-halaman | External: https://example.com</span>
                                <span id="url-help-parent_with_sub" style="display:none;">Tidak perlu URL (menu ini hanya sebagai parent/induk)</span>
                            </small>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Opsional)</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   value="{{ old('icon') }}">
                            <small class="text-muted">
                                Gunakan class icon Tabler Icons. Contoh: ti ti-home, ti ti-user
                            </small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Urutan <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', 0) }}" 
                                   min="0"
                                   step="1"
                                   required>
                            <small class="text-muted">Semakin kecil angka, semakin awal posisinya</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Menu Aktif
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Simpan Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <i class="ti ti-info-circle"></i> Panduan
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">Cara Menambah Menu:</h6>
                    <ol class="small">
                        <li><strong>Tipe Parent Only:</strong> Menu tunggal dengan URL sendiri</li>
                        <li><strong>Tipe Parent with Sub:</strong> Menu dropdown yang bisa memiliki submenu</li>
                        <li><strong>URL Internal:</strong> Gunakan format /nama-halaman</li>
                        <li><strong>URL External:</strong> Gunakan format https://example.com</li>
                        <li><strong>Icon:</strong> Gunakan Tabler Icons (opsional)</li>
                        <li><strong>Buat Halaman:</strong> Gunakan tombol di halaman daftar menu</li>
                    </ol>

                    <hr>

                    <h6 class="fw-bold">Contoh Penggunaan:</h6>
                    <div class="small">
                        <strong>Menu Layanan Kesehatan:</strong>
                        <ul class="mb-2">
                            <li>Posisi: Menu Baru</li>
                            <li>Judul: Layanan Kesehatan</li>
                            <li>URL: /layanan-kesehatan</li>
                            <li>Type: Internal</li>
                        </ul>

                        <strong>Submenu di Profil:</strong>
                        <ul class="mb-0">
                            <li>Posisi: Profil (Submenu)</li>
                            <li>Judul: Sejarah</li>
                            <li>URL: /sejarah</li>
                            <li>Type: Internal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const targetInput = document.getElementById('target');
    const typeSelect = document.getElementById('type');
    const urlInput = document.getElementById('url');
    
    // Auto-generate slug from title
    titleInput.addEventListener('keyup', function() {
        const title = this.value;
        
        // Generate slug via AJAX
        fetch('/admin/menu/slug?title=' + encodeURIComponent(title))
            .then(response => response.json())
            .then(data => {
                slugInput.value = data.slug;
            });
    });
    
    // Auto-detect link type from URL and set target
    urlInput.addEventListener('input', function() {
        const url = this.value.trim();
        // Check if external link (starts with http:// or https://)
        if (url.match(/^https?:\/\//)) {
            targetInput.value = '_blank';
        } else {
            targetInput.value = '_self';
        }
    });
    
    // Handle type menu change
    typeSelect.addEventListener('change', function() {
        const type = this.value;
        
        // Hide all help texts first
        document.querySelectorAll('[id^="url-help-"]').forEach(el => el.style.display = 'none');
        
        if (type) {
            const helpText = document.getElementById('url-help-' + type);
            if (helpText) {
                helpText.style.display = 'inline';
            }
        }
        
        // Handle parent_only vs parent_with_sub
        if (type === 'parent_only') {
            // Parent only: enable URL
            urlInput.disabled = false;
            urlInput.readOnly = false;
            urlInput.required = true;
            urlInput.placeholder = '';
        } else if (type === 'parent_with_sub') {
            // Parent with sub: disable URL
            urlInput.disabled = true;
            urlInput.value = '';
            urlInput.required = false;
            urlInput.placeholder = 'Tidak perlu URL untuk menu parent';
        } else {
            // No type selected: reset
            urlInput.disabled = false;
            urlInput.readOnly = false;
            urlInput.required = false;
        }
    });
    
    // Trigger on page load if type already selected
    if (typeSelect.value) {
        typeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
