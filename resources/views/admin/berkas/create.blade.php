@extends('admin.layouts.app')

@section('title', 'Tambah Berkas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Berkas Baru</h3>
                </div>
                <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="judul">Judul <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul berkas"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="3"
                                      placeholder="Masukkan deskripsi berkas (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control @error('kategori') is-invalid @enderror" 
                                            id="kategori" 
                                            name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Formulir" {{ old('kategori') == 'Formulir' ? 'selected' : '' }}>Formulir</option>
                                        <option value="Panduan" {{ old('kategori') == 'Panduan' ? 'selected' : '' }}>Panduan</option>
                                        <option value="Dokumen" {{ old('kategori') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                                        <option value="SOP" {{ old('kategori') == 'SOP' ? 'selected' : '' }}>SOP</option>
                                        <option value="Laporan" {{ old('kategori') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status"
                                            required>
                                        <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non-Aktif" {{ old('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('file') is-invalid @enderror" 
                                       id="file" 
                                       name="file"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                       required>
                                <label class="custom-file-label" for="file">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">
                                Format yang didukung: PDF, Word, Excel, PowerPoint, ZIP, RAR. Maksimal 10MB
                            </small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('berkas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush
@endsection
