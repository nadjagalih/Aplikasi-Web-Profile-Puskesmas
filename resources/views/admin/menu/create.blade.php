@extends('admin.layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title fw-semibold text-white mb-0">Tambah Menu Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
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
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug') }}" 
                                           readonly>
                                    <small class="text-muted">Slug akan dibuat otomatis dari judul</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe Menu <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="parent_only" {{ old('type') == 'parent_only' ? 'selected' : '' }}>Parent Only</option>
                                        <option value="parent_with_sub" {{ old('type') == 'parent_with_sub' ? 'selected' : '' }}>Parent with Sub</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input type="text" 
                                           class="form-control @error('url') is-invalid @enderror" 
                                           id="url" 
                                           name="url" 
                                           value="{{ old('url') }}"
                                           placeholder="Contoh: /berita atau https://example.com">
                                    <small class="text-muted">
                                        <span id="url-help-parent_only" style="display:none;">URL untuk halaman (contoh: /profil, /kontak)</span>
                                        <span id="url-help-parent_with_sub" style="display:none;">Tidak perlu URL (menu ini hanya sebagai parent/induk)</span>
                                    </small>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon (Opsional)</label>
                                    <input type="text" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" 
                                           name="icon" 
                                           value="{{ old('icon') }}"
                                           placeholder="Contoh: ti ti-home">
                                    <small class="text-muted">Gunakan class icon Tabler Icons</small>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', 0) }}" 
                                           min="0"
                                           required>
                                    <small class="text-muted">Semakin kecil angka, semakin di depan</small>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="position" value="header">
                        <input type="hidden" name="target" value="_self">

                        <div class="mb-3">
                            <div class="form-check">
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

                        <div class="mb-3" id="create_page_wrapper" style="display:none;">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="create_page" 
                                       name="create_page" 
                                       value="1" 
                                       {{ old('create_page', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="create_page">
                                    Buat Halaman Otomatis
                                </label>
                                <small class="form-text text-muted d-block">
                                    Centang untuk membuat halaman dinamis yang bisa dikelola kontennya (hanya untuk Parent Only)
                                </small>
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
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Session messages with SweetAlert
    var successMessage = {!! json_encode(session('success')) !!};
    var errorMessage = {!! json_encode(session('error')) !!};

    if(successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage,
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    if(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: errorMessage,
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    // Auto generate slug from title
    $('#title').on('keyup', function() {
        const title = $(this).val();
        $.ajax({
            url: '/admin/menu/slug',
            type: 'GET',
            data: { title: title },
            success: function(response) {
                $('#slug').val(response.slug);
            },
            error: function() {
                console.error('Gagal generate slug');
            }
        });
    });

    // Show URL help text based on type
    $('#type').change(function() {
        const type = $(this).val();
        $('[id^="url-help-"]').hide();
        
        if(type) {
            $('#url-help-' + type).show();
        }

        // Show/hide create page checkbox and URL field based on type
        if (type === 'parent_only') {
            $('#create_page_wrapper').show();
            $('#url').prop('required', true);
        } else if (type === 'parent_with_sub') {
            $('#create_page_wrapper').hide();
            $('#create_page').prop('checked', false);
            $('#url').prop('required', false);
            $('#url').val('');
        } else {
            $('#create_page_wrapper').hide();
            $('#create_page').prop('checked', false);
            $('#url').prop('required', false);
        }
    });

    // Trigger on page load if type is already selected
    $('#type').trigger('change');
});
</script>
@endpush
@endsection
