@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Tambah Galeri</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/admin/gallery" type="button" class="btn btn-warning float-end">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/gallery" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Album <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="judul" id="judul"
                            value="{{ old('judul') }}">
                        @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <img src="" class="img-preview img-fluid mb-3 mt-2" id="coverPreview"
                            style="border-radius: 5px; max-height:300px; overflow:hidden;"><br>
                        <label for="cover_image" class="form-label">Foto Sampul Album <span style="color: red">*</span></label>
                        <input class="form-control" type="file" id="cover_image" name="cover_image"
                            onchange="previewCoverImage()">
                        @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Foto sampul akan menjadi gambar representasi album</small>
                    </div>

                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> Setelah album dibuat, Anda bisa menambahkan foto-foto ke dalam album pada halaman detail album.
                    </div>

                    <button type="submit" class="btn btn-primary m-1 float-end">Buat Album</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Image -->
<script>
    function previewCoverImage() {
        const preview = document.getElementById('coverPreview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection