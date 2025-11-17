@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title fw-semibold text-white mb-0">Edit Halaman: {{ $page->title }}</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $page->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="editor_content" 
                                              name="content" 
                                              rows="15">{{ old('content', $page->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Menu Terkait</label>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            @if($page->menu)
                                                <h6 class="mb-1">{{ $page->menu->title }}</h6>
                                                <small class="text-muted">{{ $page->menu->full_url }}</small>
                                            @else
                                                <small class="text-muted">Tidak ada menu terkait</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Halaman Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Update Halaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    // Simple Upload Adapter untuk handle upload gambar
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);

                    fetch('/admin/pages/upload-image', {
                        method: 'POST',
                        body: data,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.url) {
                            resolve({
                                default: result.url
                            });
                        } else {
                            reject(result.error || 'Upload failed');
                        }
                    })
                    .catch(error => {
                        reject('Upload failed: ' + error);
                    });
                }));
        }

        abort() {
            // Handle abort jika diperlukan
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    let editorContent;
    
    // Tunggu DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Ready - Initializing CKEditor...');
        
        // Editor untuk Konten dengan upload adapter
        ClassicEditor
            .create(document.querySelector('#editor_content'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'insertTable', 'blockQuote', '|',
                    'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative', '|',
                        'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
                    ],
                    upload: {
                        types: ['jpeg', 'png', 'gif', 'bmp', 'webp', 'jpg']
                    }
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .then(editor => {
                console.log('Content editor initialized with upload adapter');
                editorContent = editor;
                attachFormSubmitHandler();
            })
            .catch(error => {
                console.error('Error initializing content editor:', error);
            });
        
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
                    if (editorContent) {
                        const contentData = editorContent.getData();
                        document.querySelector('#editor_content').value = contentData;
                        console.log('Content updated');
                    }
                    console.log('Form will now submit...');
                } catch (error) {
                    console.error('Error updating textarea:', error);
                }
            });
            
            console.log('Submit handler attached successfully');
        }
    });
</script>
@endsection
