@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Edit Layanan</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/layanan" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/layanan/{{ $layanan->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="nama_layanan" class="form-label">Nama Layanan <span style="color: red">*</span></label>
                            <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" 
                                name="nama_layanan" id="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                            @error('nama_layanan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span style="color: red">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                id="editor_deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="persyaratan" class="form-label">Persyaratan</label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" 
                                id="editor_persyaratan" name="persyaratan" rows="10">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>
                            @error('persyaratan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="text" class="form-control @error('biaya') is-invalid @enderror" 
                                name="biaya" id="biaya" value="{{ old('biaya', $layanan->biaya) }}" placeholder="Contoh: Gratis, Rp 50.000, BPJS">
                            @error('biaya')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Layanan</label>
                            @if($layanan->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama_layanan }}" 
                                        class="img-thumbnail" style="max-width: 200px;">
                                    <p class="text-muted small">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                name="gambar" id="gambar" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                            @error('gambar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span style="color: red">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                                <option value="Tersedia" {{ old('status', $layanan->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Tidak Tersedia" {{ old('status', $layanan->status) == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary m-1 float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Ck Editor 5 -->
    <script>
        let editorDeskripsi, editorPersyaratan;
        let editorsReady = false;
        
        // Tunggu DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Ready - Initializing CKEditor...');
            
            // Editor untuk Deskripsi
            ClassicEditor
                .create(document.querySelector('#editor_deskripsi'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
                })
                .then(editor => {
                    console.log('Deskripsi editor initialized');
                    editorDeskripsi = editor;
                    checkEditorsReady();
                })
                .catch(error => {
                    console.error('Error initializing deskripsi editor:', error);
                });

            // Editor untuk Persyaratan
            ClassicEditor
                .create(document.querySelector('#editor_persyaratan'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
                })
                .then(editor => {
                    console.log('Persyaratan editor initialized');
                    editorPersyaratan = editor;
                    checkEditorsReady();
                })
                .catch(error => {
                    console.error('Error initializing persyaratan editor:', error);
                });
            
            function checkEditorsReady() {
                if (editorDeskripsi && editorPersyaratan) {
                    editorsReady = true;
                    console.log('All editors ready!');
                    attachFormSubmitHandler();
                }
            }
            
            function attachFormSubmitHandler() {
                const form = document.querySelector('form');
                if (!form) {
                    console.error('Form not found!');
                    return;
                }
                
                console.log('Attaching submit handler to form...');
                form.addEventListener('submit', function(e) {
                    console.log('Form submit triggered!');
                    
                    try {
                        // Update textarea dengan data dari CKEditor
                        if (editorDeskripsi) {
                            const deskripsiData = editorDeskripsi.getData();
                            document.querySelector('#editor_deskripsi').value = deskripsiData;
                            console.log('Deskripsi updated:', deskripsiData.substring(0, 50) + '...');
                        }
                        if (editorPersyaratan) {
                            const persyaratanData = editorPersyaratan.getData();
                            document.querySelector('#editor_persyaratan').value = persyaratanData;
                            console.log('Persyaratan updated:', persyaratanData.substring(0, 50) + '...');
                        }
                        console.log('Form will now submit...');
                        // Form akan tetap disubmit (tidak ada preventDefault)
                    } catch (error) {
                        console.error('Error updating textareas:', error);
                    }
                });
                
                console.log('Submit handler attached successfully');
            }
        });
    </script>
@endsection
