@extends('admin.layouts.app')

@section('title', 'Kelola Alur Pelayanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Alur Pelayanan</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Form Upload -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">{{ $alurPelayanan ? 'Update Gambar' : 'Upload Gambar' }}</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('alur-pelayanan.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="gambar">Pilih Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" 
                                                       class="custom-file-input @error('gambar') is-invalid @enderror" 
                                                       id="gambar" 
                                                       name="gambar"
                                                       accept="image/jpeg,image/png,image/jpg">
                                                <label class="custom-file-label" for="gambar">Pilih file gambar...</label>
                                            </div>
                                            @error('gambar')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Format: JPG, PNG. Maksimal 5MB</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                      id="editor" 
                                                      name="deskripsi" 
                                                      rows="13">{{ old('deskripsi', $alurPelayanan->deskripsi ?? '') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Deskripsi akan ditampilkan di bawah gambar alur pelayanan</small>
                                        </div>

                                        <div class="form-group">
                                            <div class="alert alert-light border">
                                                <strong>Langkah:</strong>
                                                <ul class="mb-0 mt-2 pl-3 small">
                                                    <li>Upload gambar alur pelayanan</li>
                                                    <li>Tambahkan deskripsi</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fas fa-save"></i> {{ $alurPelayanan ? 'Update' : 'Upload' }}
                                            </button>
                                        </div>
                                    </form>

                                    @if($alurPelayanan && $alurPelayanan->gambar)
                                        <hr>
                                        <form action="{{ route('alur-pelayanan.destroy', $alurPelayanan->id) }}" 
                                              method="POST" 
                                              id="form-hapus-alur" 
                                              class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block">
                                                <i class="fas fa-trash"></i> Hapus Data
                                            </button>
                                        </form>

                                        <div class="mt-3 border-top pt-3">
                                            <small class="text-muted d-block"><strong>File:</strong> {{ basename($alurPelayanan->gambar) }}</small>
                                            <small class="text-muted d-block"><strong>Update:</strong> {{ $alurPelayanan->updated_at->format('d M Y H:i') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Preview Gambar -->
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Preview Gambar</h5>
                                </div>
                                <div class="card-body text-center" style="min-height: 300px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                    @if($alurPelayanan && $alurPelayanan->gambar)
                                        <img src="{{ asset('storage/' . $alurPelayanan->gambar) }}" 
                                             alt="Alur Pelayanan" 
                                             class="img-fluid"
                                             style="max-height: 400px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    @else
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image" style="font-size: 60px; opacity: 0.3;"></i>
                                            <p class="mt-3">Belum ada gambar</p>
                                            <small>Upload di form sebelah</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    // CK Editor 5
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
             editorInstance = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
@endsection
