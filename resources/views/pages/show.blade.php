@extends('layouts.main')

@section('title', $page->title)

@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')

<!-- Page Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">{{ $page->title }}</h1>
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.page-header h1 {
    color: white;
    font-weight: 600;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.page-content {
    font-size: 16px;
    line-height: 1.8;
    word-wrap: break-word;
    overflow-wrap: break-word;
    overflow-x: hidden;
}

/* Force all images to be responsive */
.page-content img,
.page-content figure img,
.page-content figure.image img,
.page-content picture img,
.page-content p img,
.page-content div img {
    max-width: 100% !important;
    width: auto !important;
    height: auto !important;
    border-radius: 8px;
    margin: 20px auto;
    display: block;
    object-fit: contain;
}

/* Override inline styles from CKEditor */
.page-content figure,
.page-content figure.image,
.page-content picture,
.page-content p,
.page-content div {
    max-width: 100% !important;
}

.page-content figure.image {
    display: block !important;
    width: auto !important;
    margin: 20px auto !important;
}

/* Remove any fixed width on figures */
.page-content figure[style*="width"] {
    width: auto !important;
}

/* Ensure container doesn't overflow */
.page-content * {
    max-width: 100%;
    box-sizing: border-box;
}

.page-content h2 {
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 600;
}

.page-content h3 {
    margin-top: 25px;
    margin-bottom: 12px;
    font-weight: 600;
}

.page-content p {
    margin-bottom: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.page-content ul, .page-content ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.page-content table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    border: 1px solid #ddd;
}

.page-content table thead {
    background-color: #4a90e2;
    color: white;
}

.page-content table thead th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid #3a7bc8;
}

.page-content table tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background-color 0.2s ease;
}

.page-content table tbody tr:last-child {
    border-bottom: 1px solid #ddd;
}

.page-content table tbody tr:hover {
    background-color: #f0f8ff;
}

.page-content table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.page-content table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

.page-content table tbody tr:nth-child(odd):hover {
    background-color: #f0f8ff;
}

.page-content table tbody tr:nth-child(even):hover {
    background-color: #f0f8ff;
}

.page-content table td {
    padding: 10px 15px;
    font-size: 14px;
    color: #333;
    vertical-align: middle;
    border: 1px solid #ddd;
}

.page-content table th {
    text-align: left;
    vertical-align: middle;
}

.page-content table td:first-child,
.page-content table th:first-child {
    padding-left: 20px;
}

.page-content table td:last-child,
.page-content table th:last-child {
    padding-right: 20px;
}

/* Responsive table */
@media screen and (max-width: 768px) {
    .page-content table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .page-content table thead th {
        padding: 12px 10px;
        font-size: 12px;
    }
    
    .page-content table td {
        padding: 10px;
        font-size: 13px;
    }

    /* Responsive images for mobile */
    .page-content img {
        max-width: 100% !important;
        width: 100% !important;
        height: auto !important;
        margin: 15px 0 !important;
    }

    .page-content figure,
    .page-content figure.image {
        max-width: 100% !important;
        width: 100% !important;
        margin: 15px 0 !important;
    }
}
</style>
@endpush
