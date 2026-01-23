@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Edit Galeri</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/admin/gallery" type="button" class="btn btn-warning float-end">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/gallery/{{ $album->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Album <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="judul" id="judul"
                            value="{{ old('judul', $album->judul) }}">
                        @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $album->cover_image) }}"
                            class="img-preview img-fluid mb-3 mt-2" id="coverPreview"
                            style="border-radius: 5px; max-height:300px; overflow:hidden;"><br>
                        <label for="cover_image" class="form-label">Foto Sampul Album</label>
                        <input class="form-control" type="file" id="cover_image" name="cover_image"
                            onchange="previewCoverImage()">
                        @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto sampul</small>
                    </div>

                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> Untuk mengelola foto dalam album, silakan <a href="/admin/gallery/{{ $album->id }}" class="alert-link">klik di sini untuk ke halaman Detail Album</a>.
                    </div>

                    <button type="submit" class="btn btn-primary m-1 float-end">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Image -->
<script>
    function previewCoverImage() {
        var preview = document.getElementById('coverPreview');
        var fileInput = document.getElementById('cover_image');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection