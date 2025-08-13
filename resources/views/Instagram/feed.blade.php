<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Instagram Feed - {{ $username }}</title>
</head>

<body>
    <h1>Feed Instagram: {{ $username }}</h1>

    @if(count($media) > 0)
    <div>
        @foreach($media as $post)
        <div style="margin-bottom: 20px;">
            <img src="{{ $post->getImageHighResolutionUrl() }}" width="300" alt="IG Image" />
            <p><strong>Caption:</strong> {{ $post->getCaption() }}</p>
            <p><a href="{{ $post->getLink() }}" target="_blank">Lihat di Instagram</a></p>
        </div>
        @endforeach
    </div>
    @else
    <p>Tidak ada postingan ditemukan.</p>
    @endif
</body>

</html>