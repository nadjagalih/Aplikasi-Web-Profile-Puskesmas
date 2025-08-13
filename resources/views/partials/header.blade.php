<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    /* Base styles for desktop */
    * {
        font-family: 'Poppins', sans-serif;
    }

    #header {
        padding: 30px 0;
        min-height: 100px;
        background-color: #fff;
        /* Tambahkan background agar tidak transparan saat menu mobile aktif */
    }

    .logo img {
        height: 65px !important;
        width: auto !important;
        max-height: none !important;
    }

    #navbar ul {
        list-style: none;
        /* Hapus bullet point default */
    }

    #navbar ul li {
        margin-left: 16px;
    }

    #navbar ul li a {
        font-size: 16px;
        font-weight: 600;
        color: #000;
        position: relative;
        padding: 10px 12px;
        text-decoration: none;
        transition: color 0.3s ease;
        display: inline-block;
        /* Agar padding dan efek after bekerja dengan baik */
    }

    #navbar ul li a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #0d6efd;
        transition: width 0.3s ease;
    }

    #navbar ul li a:hover::after,
    #navbar ul li a.active::after {
        width: 100%;
    }

    #navbar ul li a:hover,
    #navbar ul li a.active {
        color: #0d6efd;
    }

    /* Dropdown aktif */
    #navbar ul li.dropdown.active>a::after {
        width: 100%;
    }

    #navbar ul li.dropdown.active>a {
        color: #0d6efd;
    }

    /* Tombol Masuk - Styling Desktop */
    .login-btn {
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #0d6efd;
        color: #0d6efd;
        border-radius: 4px;
        transition: all 0.3s ease;
        padding: 6px 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .login-btn:hover {
        background-color: #0d6efd;
        color: white;
    }

    /* Mobile specific styles */
    .mobile-nav-toggle {
        color: #000;
        font-size: 28px;
        cursor: pointer;
        display: none;
        /* Hidden on desktop */
        line-height: 0;
        transition: 0.5s;
    }

    @media (max-width: 991px) {
        #navbar ul {
            display: none;
            /* Hide desktop nav by default on mobile */
            position: fixed;
            top: 0;
            right: -100%;
            /* Start off-screen */
            width: 100%;
            /* Full width */
            height: 100vh;
            /* Full viewport height */
            background-color: #fff;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 80px;
            /* Space for header/logo */
            transition: right 0.3s ease-in-out;
            z-index: 999;
            /* Ensure it's on top */
            overflow-y: auto;
            /* Enable scrolling for long menus */
            align-items: flex-start;
            /* Align items to the start */
            padding-left: 0;
            /* Hapus padding kiri default ul */
        }

        #navbar ul.navbar-mobile {
            right: 0;
            /* Slide in when active */
        }

        #navbar ul li {
            margin: 0;
            /* Reset desktop margins */
            width: 100%;
            /* Full width for list items */
            padding: 10px 20px;
            /* Add padding for touch */
            border-bottom: 1px solid #eee;
            /* Separator for items */
        }

        /* Hapus border bawah untuk item terakhir (kecuali jika itu adalah tombol "Masuk") */
        #navbar ul li:last-of-type:not(.ms-4) {
            border-bottom: none;
        }

        #navbar ul li a {
            padding: 10px 0;
            /* Adjust padding for mobile links */
            width: 100%;
            /* Make link clickable across full width */
            display: block;
            /* Ensure full width click area */
            font-size: 18px;
            /* Larger font for readability */
        }

        #navbar ul li a::after {
            display: none;
            /* Hide underline on mobile */
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #0d6efd;
            background-color: #f8f9fa;
            /* Light background on hover/active */
        }

        /* Dropdown specific styles for mobile */
        #navbar .dropdown ul {
            position: static;
            /* Remove absolute positioning */
            display: block;
            /* Show nested items by default or manage with JS */
            background-color: #f0f0f0;
            /* Different background for sub-menu */
            padding: 10px 0 10px 20px;
            /* Indent sub-items */
            margin-top: 5px;
            width: auto;
            /* Auto width */
            height: auto;
            /* Auto height */
            right: auto;
            /* Reset right */
            transition: none;
            /* No transition on sub-menus */
            overflow: visible;
            /* Ensure content is visible */
            list-style: none;
            /* Hapus bullet point default pada sub-menu */
        }

        #navbar .dropdown .dropdown ul {
            /* For nested dropdowns */
            padding-left: 40px;
        }

        #navbar .dropdown>.dropdown-active {
            /* Class to show/hide sub-menu if using JS toggle */
            display: block;
        }

        #navbar .dropdown>a .bi-chevron-down {
            float: right;
            /* Arrow to the right */
            transform: rotate(0deg);
            transition: 0.3s;
        }

        #navbar .dropdown.dropdown-active>a .bi-chevron-down {
            transform: rotate(180deg);
            /* Rotate arrow when dropdown is active */
        }

        .mobile-nav-toggle {
            display: block;
            /* Show hamburger icon */
        }

        #header .container {
            padding: 0 15px;
            /* Adjust container padding for smaller screens */
        }

        .logo {
            margin-left: 15px;
            /* Adjust logo margin */
        }

        /* **Penting:** Tombol Masuk akan tetap seperti di desktop */
        /* Mengatur ulang style mobile yang mungkin memengaruhinya */
        #navbar ul li.ms-4 {
            /* Pastikan tidak ada perubahan margin atau padding dari mobile-specific list item */
            margin-left: 16px;
            /* Kembalikan margin desktop */
            width: auto;
            /* Biarkan lebarnya sesuai konten */
            padding: 0;
            /* Hapus padding item mobile */
            border-bottom: none;
            /* Hapus border mobile */
            flex-shrink: 0;
            /* Pastikan tidak menyusut */
        }

        #navbar ul li.ms-4 .login-btn {
            /* Pastikan tidak ada perubahan pada tombol itu sendiri */
            margin: 0;
            /* Hapus margin yang mungkin ditambahkan di mobile */
            width: auto;
            /* Hapus width full */
        }

        /* Pastikan elemen di dalam header tetap rata kanan/kiri saat mobile */
        #header .container {
            justify-content: space-between;
        }
    }

    /* Overlay untuk mobile nav */
    body.mobile-nav-active {
        overflow: hidden;
        /* Prevent scrolling when mobile nav is open */
    }

    body.mobile-nav-active:before {
        content: "";
        background: rgba(0, 0, 0, 0.6);
        position: fixed;
        inset: 0;
        z-index: 998;
        /* Below the menu, above content */


    }
</style>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1>
                <a href="/">
                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo">
                </a>
            </h1>
        </div>

        <nav id="navbar" class="navbar">
            <ul class="d-flex align-items-center m-0 p-0">
                <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="/"><span>Beranda</span></a></li>

                <li class="dropdown {{ Request::is('wilayah', 'sejarah', 'visi-misi', 'perangkat-desa', 'peta-desa', 'data-desa') ? 'active' : '' }}">
                    <a href="#"><span>Profil Kecamatan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/wilayah" class="{{ Request::is('wilayah') ? 'active' : '' }}">Wilayah</a></li>
                        <li><a href="/sejarah" class="{{ Request::is('sejarah') ? 'active' : '' }}">Sejarah</a></li>
                        <li><a href="/visi-misi" class="{{ Request::is('visi-misi') ? 'active' : '' }}">Visi & Misi</a></li>
                        <li><a href="/perangkat-desa" class="{{ Request::is('perangkat-desa') ? 'active' : '' }}">Perangkat Kecamatan</a></li>
                        <li><a href="/peta-desa" class="{{ Request::is('peta-desa') ? 'active' : '' }}">Peta Kecamatan</a></li>
                        <li><a href="/data-desa" class="{{ Request::is('data-desa') ? 'active' : '' }}">Data Kecamatan</a></li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::is('pengumuman', 'berita', 'gallery', 'apbdesa') ? 'active' : '' }}">
                    <a href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/pengumuman" class="{{ Request::is('pengumuman') ? 'active' : '' }}">Pengumuman</a></li>
                        <li><a href="/berita" class="{{ Request::is('berita') ? 'active' : '' }}">Berita</a></li>
                        <li><a href="/gallery" class="{{ Request::is('gallery') ? 'active' : '' }}">Galeri Wisata</a></li>
                        <li><a href="/apbdesa" class="{{ Request::is('apbdesa') ? 'active' : '' }}">APBKecamatan</a></li>
                    </ul>
                </li>

                <li><a class="nav-link scrollto {{ Request::is('umkm') ? 'active' : '' }}" href="/umkm"><span>UMKM</span></a></li>
                <li><a class="nav-link scrollto {{ Request::is('layanan') ? 'active' : '' }}" href="/layanan"><span>Layanan</span></a></li>
                <li><a class="nav-link scrollto {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak"><span>Kontak Kami</span></a></li>

                <li class="ms-4">
                    <a href="/login"
                        class="login-btn"
                        onmouseover="this.style.backgroundColor='#0d6efd'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0d6efd';">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </a>
                </li>
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>