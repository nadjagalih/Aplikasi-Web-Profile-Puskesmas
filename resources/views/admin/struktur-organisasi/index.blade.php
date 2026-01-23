@extends('admin.layouts.main')

@section('content')


<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-header bg-primary">
        <div class="row align-items-center">
          <div class="col-6">
            <h5 class="card-title fw-semibold text-white">Struktur Organisasi</h5>
          </div>
        </div>
      </div>

      <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
        @endif
        
        @if (session()->has('errors'))
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach (session('errors')->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {{-- Section Upload Gambar Struktur Organisasi --}}
        @if($gambarStruktur && $gambarStruktur->gambar_struktur)
          {{-- Tampilan jika sudah ada gambar --}}
          <div class="mb-3">
            <h6 class="mb-3 fw-semibold text-primary">
              <i class="ti ti-photo"></i> Gambar Struktur Organisasi
            </h6>
          </div>
          
          <div class="alert alert-info mb-4">
            <i class="ti ti-info-circle"></i> 
            Gambar struktur organisasi saat ini akan ditampilkan di halaman publik
          </div>
          
          <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $gambarStruktur->gambar_struktur) }}" 
                 class="img-fluid rounded border shadow-sm" 
                 alt="Struktur Organisasi"
                 style="max-width: 100%; max-height: 600px; object-fit: contain;">
          </div>
          
          <div class="text-center">
            <form action="{{ route('admin.struktur-organisasi.hapus-gambar') }}" 
                  method="POST" 
                  id="delete-gambar-form"
                  class="d-inline">
              @csrf
              @method('DELETE')
              <button type="button" 
                      class="btn btn-danger swal-confirm" 
                      data-form="delete-gambar-form">
                <i class="ti ti-trash"></i> Hapus Gambar
              </button>
            </form>
          </div>
        @else
          {{-- Form Upload jika belum ada gambar --}}
          <div class="mb-3">
            <h6 class="mb-3 fw-semibold text-primary">
              <i class="ti ti-photo"></i> Upload Gambar Struktur Organisasi
            </h6>
          </div>
          
          <form action="{{ route('admin.struktur-organisasi.upload-gambar') }}" 
                method="POST" 
                enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12 mb-3">
                <label class="form-label fw-semibold">
                  Pilih Gambar Struktur Organisasi
                  <span class="text-danger">*</span>
                </label>
                <input type="file" 
                       class="form-control" 
                       name="gambar_struktur" 
                       id="gambar_struktur"
                       accept="image/*"
                       onchange="previewImage(event)"
                       required>
                <small class="text-muted">
                  Format: JPG, JPEG, PNG | Maksimal: 5MB
                </small>
              </div>
              <div class="col-12 mb-3 text-center">
                <img id="preview-gambar" 
                     class="img-fluid rounded border d-none" 
                     style="max-width: 100%; max-height: 400px; object-fit: contain;">
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="ti ti-upload"></i> Upload Gambar
                </button>
              </div>
            </div>
          </form>
        @endif

      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview-gambar');
    
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush