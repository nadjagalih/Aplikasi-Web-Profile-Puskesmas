@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Menu Dinamis</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
        <li class="breadcrumb-item active">Edit Menu</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="ti ti-edit me-1"></i>
                    Form Edit Menu: <strong>{{ $menu->title }}</strong>
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

                    <form action="{{ route('menu.update', $menu) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $menu->title) }}" 
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
                                   value="{{ old('url', $menu->url) }}" 
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
                                <option value="internal" {{ old('type', $menu->type) == 'internal' ? 'selected' : '' }}>
                                    Internal (dalam website)
                                </option>
                                <option value="external" {{ old('type', $menu->type) == 'external' ? 'selected' : '' }}>
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
                                   value="{{ old('icon', $menu->icon) }}" 
                                   placeholder="ti ti-heart-pulse">
                            <small class="text-muted">
                                Gunakan Tabler Icons, contoh: ti ti-home, ti ti-user, dll.
                                <a href="https://tabler-icons.io/" target="_blank">Lihat icon</a>
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
                                   value="{{ old('order', $menu->order) }}" 
                                   min="0"
                                   step="10"
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
                                       {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
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
                                <i class="ti ti-device-floppy"></i> Update Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <i class="ti ti-info-circle"></i> Informasi Menu
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Slug:</th>
                            <td>{{ $menu->slug }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat:</th>
                            <td>{{ $menu->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Update Terakhir:</th>
                            <td>{{ $menu->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                        @if($menu->children->count() > 0)
                        <tr>
                            <th>Submenu:</th>
                            <td>
                                <span class="badge bg-primary">{{ $menu->children->count() }} submenu</span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
