@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Edit Struktur Organisasi</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.struktur-organisasi.update') }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Struktur Organisasi <span style="color: red">*</span></label>
                            <textarea class="form-control" id="editor" name="content" rows="10" required>{{ old('content', $gambarStruktur->content ?? '') }}</textarea>
                            <small class="text-muted">
                              Gunakan editor untuk menambahkan teks dan gambar struktur organisasi
                            </small>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.struktur-organisasi.index') }}" class="btn btn-secondary m-1">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary m-1">
                                <i class="ti ti-device-floppy"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CK Editor 5 -->
<script>
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            simpleUpload: {
                uploadUrl: "{{ route('admin.struktur-organisasi.upload-image', ['_token' => csrf_token()]) }}",
                withCredentials: true,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .then( editor => {
             editorInstance = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection