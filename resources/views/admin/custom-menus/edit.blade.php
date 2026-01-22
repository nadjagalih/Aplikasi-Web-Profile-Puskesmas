@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Menu Custom</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
        <li class="breadcrumb-item active">Edit Menu</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Menu Custom: <strong>{{ $customMenu->title }}</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.custom.update', $customMenu) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $customMenu->title) }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('url') is-invalid @enderror" 
                                   id="url" 
                                   name="url" 
                                   value="{{ old('url', $customMenu->url) }}" 
                                   placeholder="/layanan-kesehatan atau https://example.com"
                                   required>
                            <small class="text-muted">
                                Untuk internal: /nama-halaman | Untuk external: https://example.com
                            </small>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Link <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="internal" {{ old('type', $customMenu->type) == 'internal' ? 'selected' : '' }}>
                                    Internal (dalam website)
                                </option>
                                <option value="external" {{ old('type', $customMenu->type) == 'external' ? 'selected' : '' }}>
                                    External (link keluar - otomatis tab baru)
                                </option>
                            </select>
                            <small class="text-muted">
                                Internal: dibuka di tab yang sama | External: otomatis dibuka di tab baru
                            </small>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Opsional)</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   value="{{ old('icon', $customMenu->icon) }}" 
                                   placeholder="bi bi-heart-pulse">
                            <small class="text-muted">
                                Gunakan Bootstrap Icons, contoh: bi bi-heart-pulse, bi bi-building, dll.
                                <a href="https://icons.getbootstrap.com/" target="_blank">Lihat icon</a>
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
                                   value="{{ old('order', $customMenu->order) }}" 
                                   min="0"
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
                                       {{ old('is_active', $customMenu->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Menu Aktif
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle"></i> Informasi Menu
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Slug:</th>
                            <td>{{ $customMenu->slug }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat:</th>
                            <td>{{ $customMenu->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Update Terakhir:</th>
                            <td>{{ $customMenu->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                        @if($customMenu->children->count() > 0)
                        <tr>
                            <th>Submenu:</th>
                            <td>
                                <span class="badge bg-primary">{{ $customMenu->children->count() }} submenu</span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const parentSlugSelect = document.getElementById('parent_slug');
    const parentMenuSection = document.getElementById('parent_menu_section');
    
    parentSlugSelect.addEventListener('change', function() {
        // Show parent menu section only if "Menu Baru" is selected
        if (this.value === '') {
            parentMenuSection.style.display = 'block';
        } else {
            parentMenuSection.style.display = 'none';
            document.getElementById('parent_id').value = '';
        }
    });
});
</script>
@endsection
