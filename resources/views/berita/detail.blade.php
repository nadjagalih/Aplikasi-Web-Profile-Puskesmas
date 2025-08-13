@extends('layouts.main')

@section('content')

<style>
    /* Main News Title (h1) */
    h1 {
        color: #000;
        /* Set the main news title to black */
        text-align: left;
        /* Keep the title left-aligned */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2.2rem;
        /* Larger font size for prominence */
        line-height: 1.3;
        margin-bottom: 1rem;
        /* Space below the title */
    }

    /* Main News Body Content (paragraphs within .card-body) */
    .card-body p {
        text-align: justify;
        /* Justify text (rata kanan-kiri) */
        line-height: 1.8;
        /* Improved readability */
        color: #333;
        /* Dark gray for body text */
        margin-bottom: 1rem;
        /* Space between paragraphs */
    }

    /* Breadcrumbs/Navigation Links */
    .card-body p a {
        color: #007bff;
        /* Bootstrap primary blue for links */
        text-decoration: none;
        /* No underline */
        font-weight: 500;
    }

    .card-body p a:hover {
        text-decoration: underline;
        /* Underline on hover */
    }

    /* News Meta Info (Date, Author, Views) */
    .news-date {
        font-size: 0.9rem;
        /* Smaller font for meta info */
        color: #777;
        /* Lighter gray for meta info */
        margin-bottom: 1.5rem;
        /* Space below this block */
        display: block;
        /* Ensure it takes full width */
    }

    .news-date span {
        display: inline-block;
        /* Allows side-by-side display */
        margin-right: 0.75rem;
        /* Space between each item */
    }

    /* Featured Image */
    .card-body img.img-fluid {
        border-radius: 8px;
        /* Slightly rounded corners */
        margin-bottom: 2rem;
        /* More space below the image */
        object-fit: cover;
        /* Ensures image fills the space and looks good */
    }

    /* Tag Button */
    .btn-secondary.btn-sm {
        background-color: #6c757d;
        /* Bootstrap secondary color */
        border-color: #6c757d;
        color: #fff;
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
    }

    /* Comment Section Heading */
    h4.mt-3.mb-5 {
        color: #333;
        /* Dark gray for "Komentar" heading */
        font-weight: 600;
        font-size: 1.75rem;
    }

    /* Individual Comment Container */
    .comment-container {
        margin-bottom: 1.5rem;
        /* Space between comments */
    }

    .comment-avatar img {
        border: 1px solid #eee;
        /* Subtle border for avatars */
    }

    .comment-content h5 {
        font-size: 1.1rem;
        /* Size for commenter name */
        font-weight: 600;
        color: #222;
        /* Slightly darker for names */
        margin-bottom: 0.2rem;
    }

    .comment-content time {
        font-size: 0.8rem;
        /* Smaller font for comment time */
        color: #999;
        /* Lighter gray for time */
        display: block;
        /* New line for time */
        margin-bottom: 0.5rem;
    }

    .comment-content p {
        text-align: left;
        /* Keep comment body left-aligned, can be justified if preferred */
        font-size: 0.95rem;
        line-height: 1.6;
        color: #444;
        margin-top: 0;
        /* Adjust top margin for comment text */
    }

    .comment-header .reply {
        font-size: 0.9rem;
        color: #007bff;
        text-decoration: none;
    }

    .comment-header .reply:hover {
        text-decoration: underline;
    }

    /* Comment Reply Form */
    .reply-form {
        border: 1px solid #f0f0f0;
        padding: 1rem;
        border-radius: 8px;
        background-color: #fcfcfc;
        margin-top: 1rem;
        margin-left: 75px;
        /* Indent reply forms */
    }

    .reply-form .form-control {
        font-size: 0.9rem;
    }

    .reply-form .btn-primary {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    /* "Tinggalkan Komentar" Form */
    h5.mb-4 {
        color: #333;
        /* Dark gray for "Tinggalkan Komentar" heading */
        font-weight: 600;
        font-size: 1.25rem;
    }

    .form-label {
        font-weight: 500;
        color: #444;
    }

    .form-control {
        border-radius: 5px;
        border-color: #ddd;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Sidebar - Berita Populer & Kategori */
    .sidebar .card {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        /* Lighter shadow for sidebar cards */
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .sidebar .card-body h4 {
        color: #333;
        /* Dark gray for sidebar headings */
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #eee;
        /* Subtle separator */
        padding-bottom: 0.75rem;
    }

    .sidebar .populer-post img {
        border-radius: 4px;
        object-fit: cover;
    }

    .sidebar .populer-post h6 {
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.4;
        color: #333;
    }

    .sidebar .populer-post a {
        text-decoration: none;
    }

    .sidebar .populer-post a:hover h6 {
        color: #007bff;
        /* Change color on hover */
    }

    .sidebar ul {
        list-style: none;
        /* Remove default list bullets */
        padding: 0;
        margin: 0;
    }

    .sidebar ul p {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .sidebar ul p i {
        margin-right: 0.5rem;
        color: #666;
    }

    .sidebar ul p a {
        color: #444;
        text-decoration: none;
    }

    .sidebar ul p a:hover {
        color: #007bff;
    }

    /* Overall Section/Container Padding */
    .counts.section-bg {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #f9fafb;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <p>Berita >> <a href="{{ $berita->slug }}">{{ $berita->judul }}</a></p>
                                <h1>{{ $berita->judul }}</h1>

                                <div class="news-date mb-4">
                                    <span class="mr-3"> <i class="bi bi-stopwatch-fill"></i> {{ $berita->created_at->diffForHumans() }}</span> |
                                    <span class="mr-3"><i class="bi bi-person-circle"> {{ $berita->user->name }}</i></span> |
                                    <span><i class="bi bi-fire">Dibaca {{ $berita->views }} Kali</i></span>
                                </div>

                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Andalan" class="img-fluid rounded mb-5" style="height: 450px; width: 100%;">
                                <p>{!! $berita->body !!}</p>

                                <i class="bi bi-tags"></i> <a href="#" type="button" class="btn btn-secondary btn-sm my-2">{{ $berita->kategori->kategori }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- Comment Form --}}
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="container mb-3">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <h4 class="mt-3 mb-5">Komentar</h4>

                                            @foreach ($berita->comments as $comment)
                                            @php
                                            $emailHash = md5(strtolower(trim($comment->email)));
                                            $avatarUrl = "https://www.gravatar.com/avatar/{$emailHash}?s=65";
                                            @endphp

                                            <div class="comment-container mb-4 d-flex align-items-start">
                                                <div class="comment-avatar me-3">
                                                    <img class="rounded-circle shadow-1-strong" src="{{ $avatarUrl }}" alt="Avatar" width="65" height="65">
                                                </div>
                                                <div class="comment-content flex-grow-1">
                                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                                        <h5>{{ $comment->nama }}</h5>
                                                        <a href="javascript:void(0)" onclick="toggleReplyForm('{{ $comment->id }}')" class="reply"><i class="bi bi-reply-fill"></i> Balas</a>
                                                    </div>
                                                    <time datetime="2020-01-01"> {{ $comment->created_at->diffForHumans() }}</time>
                                                    <p class="mt-2">{{ $comment->body }}</p>
                                                </div>
                                            </div>

                                            @foreach ($comment->replies as $reply)
                                            @php
                                            $replyEmailHash = md5(strtolower(trim($reply->email)));
                                            $replyAvatarUrl = "https://www.gravatar.com/avatar/{$replyEmailHash}?s=65";
                                            @endphp
                                            <div class="comment-container my-4 ms-5 d-flex align-items-start">
                                                <div class="comment-avatar me-3">
                                                    <img class="rounded-circle shadow-1-strong" src="{{ $replyAvatarUrl }}" alt="Avatar" width="65" height="65">
                                                </div>
                                                <div class="comment-content flex-grow-1">
                                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                                        <h5>{{ $reply->nama }}</h5>
                                                    </div>
                                                    <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</time>
                                                    <p class="mt-2">{{ $reply->body }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div id="replyForm{{ $comment->id }}" class="reply-form mb-3" style="display: none;">
                                                <form action="/berita/{{ $berita->slug }}/reply" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $comment->id }}" name="comment_id">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama" name="replyNama">
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="email" class="form-control" placeholder="Email" name="replyEmail">
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea class="form-control" placeholder="Balasan Komentar" name="replyBody" rows="3"></textarea>
                                                    </div>
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                                </form>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-4">Tinggalkan Komentar : </h5>
                                <form method="POST" action="/berita/{{ $berita->slug }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="body" class="form-label">Komentar</label>
                                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="6"></textarea>
                                        @error('body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-end">Kirim Komentar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card">
                        <div class="card-body">
                            <h4>Berita Populer</h4>
                            <div class="populer-post mb-5">
                                @foreach ($beritaPopuler as $berita)
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" width="100%" height="100%" style="border-radius: 5px">
                                    </div>
                                    <div class="col-md-7 mt-2">
                                        <a href="/berita/{{ $berita->slug }}" style="color: inherit;">
                                            <h6>{{ $berita->judul }}</h6>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-body">
                            <h4>Kategori</h4>
                            <div class="populer-post mb-5">
                                <div class="row mt-3">
                                    <div class="col">
                                        @foreach ($kategories as $kategori)
                                        <ul>
                                            <p><i class="bi bi-hash"></i> <a href="/kategori/{{ $kategori->slug }}" style="color: inherit;">{{ $kategori->kategori }}</a></p>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function toggleReplyForm(commentId) {
        var replyForm = document.getElementById('replyForm' + commentId);
        var formDisplayStyle = window.getComputedStyle(replyForm).getPropertyValue('display');
        if (formDisplayStyle === 'none') {
            replyForm.style.display = 'block';
        } else {
            replyForm.style.display = 'none';
        }
    }
</script>

@endsection