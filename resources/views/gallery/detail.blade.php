@extends('layouts.main')

@section('content')

<style>
    .section-title h2 {
        color: #000;
        text-align: center;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .img-thumbnail {
        border: 1px solid #ddd;
        padding: 4px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.3s;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.3rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .counts.section-bg {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #f9fafb;
    }

    /* Modal Image Styles */
    .modal-dialog {
        max-width: 800px;
        margin: 1.75rem auto;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 8px;
    }

    .modal-image {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
        margin: auto;
        display: block;
        border-radius: 8px;
    }

    .modal-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 1060;
    }

    .modal-nav-btn:hover {
        background-color: #0056b3;
        transform: translateY(-50%) scale(1.1);
    }

    .modal-nav-btn.prev {
        left: 10px;
    }

    .modal-nav-btn.next {
        right: 10px;
    }

    .modal-counter {
        text-align: center;
        padding: 10px;
        font-weight: 600;
        color: #333;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }
</style>

@php
    $imageUrls = $album->images->map(function($img) {
        return asset('storage/' . $img->gambar);
    })->toArray();
@endphp

<section class="counts section-bg">
    <div class="section-title">
        <h2>{{ $album->judul }}</h2>
        @if($album->deskripsi)
            <p class="mt-2 text-muted">{{ $album->deskripsi }}</p>
        @endif
    </div>
    <div class="container">
        @if($album->images->count() > 0)
            <div class="row">
                @foreach($album->images as $index => $image)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="gallery-item" data-index="{{ $index }}" style="cursor: pointer;">
                        <img src="{{ asset('storage/' . $image->gambar) }}" 
                             class="img-fluid img-thumbnail"
                             alt="Foto {{ $index + 1 }}"
                             style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">Album ini belum memiliki foto.</p>
            </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">← Kembali</a>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body position-relative p-0">
                <button class="modal-nav-btn prev" onclick="prevImage()">‹</button>
                <button class="modal-nav-btn next" onclick="nextImage()">›</button>
                <div class="p-3 text-center">
                    <img id="modalImage" src="" alt="Image" class="modal-image">
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <div class="modal-counter w-100" id="imageCounter"></div>
            </div>
        </div>
    </div>
</div>

<script id="image-data" type="application/json">
<?php echo json_encode($imageUrls, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
</script>

<script>
    const images = JSON.parse(document.getElementById('image-data').textContent);
    
    let currentImageIndex = 0;
    let modalInstance = null;

    // Add click event to all image containers
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.gallery-item').forEach(function(element) {
            element.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                openImageModal(index);
            });
        });
    });

    function openImageModal(index) {
        currentImageIndex = index;
        updateModalImage();
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
        modalInstance = modal;
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateModalImage();
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateModalImage();
    }

    function updateModalImage() {
        document.getElementById('modalImage').src = images[currentImageIndex];
        document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${images.length}`;
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imageModal');
        if (modal.classList.contains('show')) {
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'Escape') {
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
        }
    });
</script>
@endsection
