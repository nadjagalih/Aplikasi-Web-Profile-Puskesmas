@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Album Info Card -->
        <div class="card mb-3">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white mb-0">Detail Album: {{ $album->judul }}</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/admin/gallery/{{ $album->id }}/edit" class="btn btn-warning me-2">
                            <i class="ti ti-edit"></i> Edit Album
                        </a>
                        <a href="/admin/gallery" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Album" 
                             class="img-fluid rounded" style="width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $album->judul }}</h4>
                        <p class="text-muted">{{ $album->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        <p class="mb-0"><strong>Jumlah Foto:</strong> {{ $album->images->count() }} foto</p>
                        <p class="mb-0"><strong>Dibuat:</strong> {{ $album->created_at->format('d M Y H:i') }}</p>
                        <p class="mb-0"><strong>Terakhir Update:</strong> {{ $album->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Images Card -->
        <div class="card">
            <div class="card-header bg-success">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white mb-0">Foto dalam Album</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addImageModal">
                            <i class="ti ti-plus"></i> Tambah Foto
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal menyimpan foto!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($album->images->count() > 0)
                    <div class="row" id="existing-images">
                        @foreach($album->images as $image)
                        <div class="col-md-2 col-sm-4 col-6 mb-3" id="image-{{ $image->id }}">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image->gambar) }}" class="card-img-top" 
                                     style="height: 150px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-warning btn-sm flex-fill btn-edit-image" 
                                                data-image-id="{{ $image->id }}"
                                                data-image-src="{{ asset('storage/' . $image->gambar) }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm flex-fill btn-delete-image" 
                                                data-image-id="{{ $image->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="ti ti-photo-off" style="font-size: 64px; color: #ccc;"></i>
                        <p class="text-muted mt-3">Belum ada foto di album ini.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">
                            <i class="ti ti-plus"></i> Tambah Foto Pertama
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Images -->
<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('gallery.storeImages', $album->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addImageModalLabel">Tambah Foto ke Album</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto <span style="color: red">*</span></label>
                        <input class="form-control mb-2" type="file" id="addImageFile" name="images[]" accept="image/png,image/jpeg,image/jpg" required onchange="previewAddImage(event)">
                        <small class="text-muted">Format: PNG, JPG, JPEG (Max 5MB)</small>
                        <div id="addImagePreviewContainer" class="text-center mt-3" style="display: none;">
                            <img id="addImagePreview" src="" alt="Preview" class="img-fluid" style="max-height: 300px; border-radius: 8px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Image -->
<div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="editImageForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="editImageModalLabel">Edit Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img id="editImagePreview" src="" alt="Preview" class="img-fluid" style="max-height: 300px; border-radius: 8px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto <span style="color: red">*</span></label>
                        <input class="form-control" type="file" name="gambar" accept="image/png,image/jpeg,image/jpg" required onchange="previewEditImage(event)">
                        <small class="text-muted">Format: PNG, JPG, JPEG (Max 5MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit button event listener
        document.querySelectorAll('.btn-edit-image').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.dataset.imageId;
                const imageSrc = this.dataset.imageSrc;
                
                // Set form action
                document.getElementById('editImageForm').action = `/admin/album-image/${imageId}`;
                
                // Set preview image
                document.getElementById('editImagePreview').src = imageSrc;
                
                // Show modal
                var modal = new bootstrap.Modal(document.getElementById('editImageModal'));
                modal.show();
            });
        });
        
        // Delete button event listener
        document.querySelectorAll('.btn-delete-image').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.dataset.imageId;
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Foto ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/album-image/${imageId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`image-${imageId}`).remove();
                                
                                // Update jumlah foto
                                const remainingImages = document.querySelectorAll('#existing-images > div').length;
                                if (remainingImages === 0) {
                                    location.reload();
                                }
                                
                                // Show success message with SweetAlert
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus gambar',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghapus gambar',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        });
    });
    
    // Clear form when add modal is opened
    const addImageModal = document.getElementById('addImageModal');
    addImageModal.addEventListener('show.bs.modal', function () {
        document.getElementById('addImageFile').value = '';
        document.getElementById('addImagePreviewContainer').style.display = 'none';
    });
    
    function previewAddImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('addImagePreview').src = e.target.result;
                document.getElementById('addImagePreviewContainer').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    
    function previewEditImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('editImagePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
