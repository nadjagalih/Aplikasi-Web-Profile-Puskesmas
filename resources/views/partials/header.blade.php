<link href="/vendor/fonts/fonts.css" rel="stylesheet">
<link href="/vendor/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">

<style>
    /* Base styles for desktop */
    * {
        font-family: 'Poppins', sans-serif;
    }

    #header {
        padding: 12px 0 !important;
        min-height: 70px !important;
        height: auto !important;
        background-color: #fff !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
        position: sticky;
        top: 0;
        z-index: 997;
    }

    #header .container {
        max-width: 1320px;
        margin: 0 auto;
    }

    .logo img {
        height: 50px !important;
        width: auto !important;
        max-height: none !important;
    }

    #navbar ul {
        list-style: none;
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

    /* Dropdown Desktop */
    #navbar .dropdown {
        position: relative;
    }

    #navbar .dropdown ul {
        display: none;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        padding: 8px 0;
        min-width: 240px;
        z-index: 99;
    }

    #navbar .dropdown:hover > ul {
        display: block;
    }

    /* Area hover yang lebih luas */
    #navbar .dropdown::before {
        content: '';
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        height: 10px;
        background: transparent;
    }

    #navbar .dropdown ul li {
        margin: 0;
        padding: 0;
    }

    #navbar .dropdown ul li a {
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 500;
        display: block;
        width: 100%;
        transition: all 0.2s ease;
    }

    #navbar .dropdown ul li a:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        padding-left: 25px;
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
        padding: 8px 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .login-btn:hover {
        background-color: #0d6efd;
        color: white !important;
    }

    /* Tombol Login SKM - Styling Desktop */
    .login-skm-btn {
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #17a2b8;
        color: #0046FF;
        border-radius: 4px;
        transition: all 0.3s ease;
        padding: 8px 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .login-skm-btn:hover {
        background-color: #0046FF;
        color: white !important;
    }

    /* Mobile Navigation Toggle */
    .mobile-nav-toggle {
        color: #000;
        font-size: 32px;
        cursor: pointer;
        display: none;
        line-height: 0;
        transition: 0.3s;
        padding: 8px;
    }

    .mobile-nav-toggle:hover {
        color: #0d6efd;
    }

    /* Mobile & Tablet Responsive */
    @media (max-width: 991px) {
        #header {
            padding: 10px 0 !important;
            min-height: 60px !important;
        }

        #header .container {
            padding: 0 15px;
            justify-content: space-between;
        }

        .logo img {
            height: 40px !important;
        }

        .mobile-nav-toggle {
            display: block;
        }

        /* Desktop login button - hide on mobile */
        #navbar > ul > li.ms-4,
        #navbar > ul > li.ms-2 {
            display: none;
        }

        /* Mobile Menu Sidebar */
        #navbar ul {
            display: none;
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100vh;
            background-color: #fff;
            flex-direction: column;
            justify-content: flex-start;
            padding: 20px 0;
            transition: right 0.3s ease-in-out;
            z-index: 9999;
            overflow-y: auto;
            align-items: flex-start;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        }

        #navbar ul.navbar-mobile {
            right: 0;
            display: flex;
        }

        #navbar ul li {
            margin: 0;
            width: 100%;
            padding: 0;
            border-bottom: 1px solid #f0f0f0;
        }

        #navbar ul li:first-child {
            margin-top: 60px;
        }

        #navbar ul li:last-child {
            border-bottom: none;
        }

        #navbar ul li a {
            padding: 15px 25px;
            width: 100%;
            display: flex;
            align-items: center;
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }

        #navbar ul li a::after {
            display: none;
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #0d6efd;
            background-color: #f8f9fa;
        }

        #navbar ul li a i {
            margin-right: 8px;
        }

        /* Dropdown Mobile */
        #navbar .dropdown > a {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #navbar .dropdown ul {
            position: static;
            display: none;
            background-color: #f8f9fa;
            padding: 0;
            margin: 0;
            width: 100%;
            box-shadow: none;
            border-radius: 0;
        }

        #navbar .dropdown.dropdown-active > ul {
            display: block;
        }

        #navbar .dropdown ul li {
            border-bottom: 1px solid #e9ecef;
        }

        #navbar .dropdown ul li:last-child {
            border-bottom: none;
        }

        #navbar .dropdown ul li a {
            padding-left: 45px;
            font-size: 14px;
            color: #555;
        }

        #navbar .dropdown > a .bi-chevron-down {
            transition: transform 0.3s;
            font-size: 16px;
        }

        #navbar .dropdown.dropdown-active > a .bi-chevron-down {
            transform: rotate(180deg);
        }

        /* Mobile Login Button */
        .login-mobile {
            display: block;
            width: 100%;
            padding: 20px 25px;
            border-top: 2px solid #e9ecef;
            margin-top: auto;
        }

        .login-mobile a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 600;
            background-color: #0d6efd;
            color: white !important;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-mobile a:hover {
            background-color: #0c5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        /* Mobile Login SKM Button */
        .login-skm-mobile {
            display: block;
            width: 100%;
            padding: 0 25px 20px 25px;
        }

        .login-skm-mobile a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 600;
            background-color: #0046FF;
            color: white !important;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-skm-mobile a:hover {
            background-color: #138496;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        }
    }

    /* Hide mobile login button on desktop */
    .login-mobile,
    .login-skm-mobile {
        display: none;
    }

    /* Overlay untuk mobile nav - DISABLED */
    body.mobile-nav-active {
        overflow: hidden;
    }

    /* Extra Small Mobile */
    @media (max-width: 575px) {
        #navbar ul {
            width: 100%;
        }

        .logo img {
            height: 35px !important;
        }

        #navbar ul li a {
            font-size: 14px;
        }

        .login-mobile a {
            font-size: 14px;
            padding: 10px 16px;
        }
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
                @php
                    $headerMenus = get_menus('header');
                    $currentPath = Request::path();
                @endphp
                
                {{-- Menu Statis Beranda --}}
                <li>
                    <a class="nav-link scrollto {{ $currentPath === '' || $currentPath === '/' ? 'active' : '' }}" 
                       href="/">
                        <span>Beranda</span>
                    </a>
                </li>
                
                {{-- Menu Statis Profil --}}
                <li class="dropdown {{ Request::is('profil*') || Request::is('sambutan') || Request::is('visi-misi') || Request::is('struktur-organisasi') ? 'active' : '' }}">
                    <a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li>
                            <a href="/sambutan" class="{{ Request::is('sambutan') ? 'active' : '' }}">
                                Sambutan
                            </a>
                        </li>
                        <li>
                            <a href="/profil" class="{{ Request::is('profil') ? 'active' : '' }}">
                                Profil Puskemas
                            </a>
                        </li>
                        <li>
                            <a href="/visi-misi" class="{{ Request::is('visi-misi') ? 'active' : '' }}">
                                Visi & Misi
                            </a>
                        </li>
                        <li>
                            <a href="/struktur-organisasi" class="{{ Request::is('struktur-organisasi') ? 'active' : '' }}">
                                Struktur Organisasi
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Menu Statis Informasi --}}
                <li class="dropdown {{ Request::is('berita*') || Request::is('pengumuman*') || Request::is('agenda*') || Request::is('gallery*') || Request::is('berkas*') ? 'active' : '' }}">
                    <a href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li>
                            <a href="/berita" class="{{ Request::is('berita*') ? 'active' : '' }}">
                                Berita
                            </a>
                        </li>
                        <li>
                            <a href="/pengumuman" class="{{ Request::is('pengumuman*') ? 'active' : '' }}">
                                Pengumuman
                            </a>
                        </li>
                        <li>
                            <a href="/agenda" class="{{ Request::is('agenda*') ? 'active' : '' }}">
                                Agenda
                            </a>
                        </li>
                        <li>
                            <a href="/gallery" class="{{ Request::is('gallery*') ? 'active' : '' }}">
                                Galeri
                            </a>
                        </li>
                        <li>
                            <a href="/berkas" class="{{ Request::is('berkas*') ? 'active' : '' }}">
                                Berkas
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Menu Statis Alur Pelayanan --}}
                <li>
                    <a class="nav-link scrollto {{ Request::is('alur-pelayanan') ? 'active' : '' }}" 
                       href="/alur-pelayanan">
                        <span>Alur Pelayanan</span>
                    </a>
                </li>
                
                {{-- Menu Dinamis dari Database --}}
                @foreach($headerMenus as $menu)
                    @php
                        $menuUrl = ltrim($menu->full_url, '/');
                        $isActive = ($currentPath === $menuUrl || Request::is($menuUrl)) ? 'active' : '';
                        $hasChildren = $menu->activeChildren->count() > 0;
                        
                        // Cek apakah ada child yang aktif
                        $hasActiveChild = false;
                        if($hasChildren) {
                            foreach($menu->activeChildren as $child) {
                                $childUrl = ltrim($child->full_url, '/');
                                if($currentPath === $childUrl || Request::is($childUrl)) {
                                    $hasActiveChild = true;
                                    break;
                                }
                            }
                        }
                        
                        // Parent dropdown aktif jika parent URL cocok ATAU ada child yang aktif
                        $isActive = ($isActive === 'active' || $hasActiveChild) ? 'active' : '';
                    @endphp
                    
                    @if($hasChildren)
                        {{-- Menu with Dropdown --}}
                        <li class="dropdown {{ $isActive }}">
                            <a href="#"><span>{{ $menu->title }}</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                @foreach($menu->activeChildren as $child)
                                    @php
                                        $childUrl = ltrim($child->full_url, '/');
                                        $childActive = ($currentPath === $childUrl || Request::is($childUrl)) ? 'active' : '';
                                        // Check if external link (starts with http:// or https://)
                                        $isExternal = preg_match('/^https?:\/\//', $child->url);
                                        $childHref = $isExternal ? $child->url : url($child->full_url);
                                    @endphp
                                    <li>
                                        <a href="{{ $childHref }}" 
                                           class="{{ $childActive }}" 
                                           target="{{ $child->target }}">
                                            @if($child->icon)
                                                <i class="{{ $child->icon }}"></i>
                                            @endif
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        {{-- Single Menu Item --}}
                        @php
                            // Check if external link
                            $isMenuExternal = preg_match('/^https?:\/\//', $menu->url);
                            $menuHref = $isMenuExternal ? $menu->url : url($menu->full_url);
                        @endphp
                        <li>
                            <a class="nav-link scrollto {{ $isActive }}" 
                               href="{{ $menuHref }}" 
                               target="{{ $menu->target }}">
                                <span>
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }}"></i>
                                    @endif
                                    {{ $menu->title }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach

                <!-- Desktop Login SKM Button -->
                @php
                    $skmConfig = \App\Models\SkmConfig::first();
                @endphp
                @if($skmConfig && $skmConfig->login_url)
                <li class="ms-4">
                    <a href="{{ $skmConfig->login_url }}" target="_blank" class="login-btn">
                        Isi SKM
                    </a>
                </li>
                @endif

                <!-- Mobile Login SKM Button (shown only in mobile menu) -->
                @if($skmConfig && $skmConfig->login_url)
                <li class="login-skm-mobile">
                    <a href="{{ $skmConfig->login_url }}" target="_blank">
                        Login SKM
                    </a>
                </li>
                @endif
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Mobile Navigation Toggle
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navbar = document.querySelector('#navbar ul');
    const body = document.body;

    if (mobileNavToggle) {
        mobileNavToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navbar.classList.toggle('navbar-mobile');
            body.classList.toggle('mobile-nav-active');
            
            // Toggle icon between menu and close
            if (navbar.classList.contains('navbar-mobile')) {
                this.classList.remove('bi-list');
                this.classList.add('bi-x');
            } else {
                this.classList.remove('bi-x');
                this.classList.add('bi-list');
            }
        });
    }

    // Mobile Dropdown Toggle
    const dropdownLinks = document.querySelectorAll('#navbar .dropdown > a');
    
    dropdownLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                const parent = this.parentElement;
                
                // Close other dropdowns
                dropdownLinks.forEach(function(otherLink) {
                    if (otherLink !== link) {
                        otherLink.parentElement.classList.remove('dropdown-active');
                    }
                });
                
                // Toggle current dropdown
                parent.classList.toggle('dropdown-active');
            }
        });
    });

    // Close mobile menu when clicking on a link (except dropdown triggers)
    const navLinks = document.querySelectorAll('#navbar ul li:not(.dropdown) > a, #navbar .dropdown ul li a');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (navbar.classList.contains('navbar-mobile')) {
                navbar.classList.remove('navbar-mobile');
                body.classList.remove('mobile-nav-active');
                mobileNavToggle.classList.remove('bi-x');
                mobileNavToggle.classList.add('bi-list');
                
                // Close all dropdowns
                document.querySelectorAll('#navbar .dropdown').forEach(function(dropdown) {
                    dropdown.classList.remove('dropdown-active');
                });
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            navbar.classList.remove('navbar-mobile');
            body.classList.remove('mobile-nav-active');
            mobileNavToggle.classList.remove('bi-x');
            mobileNavToggle.classList.add('bi-list');
            
            // Close all dropdowns
            document.querySelectorAll('#navbar .dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('dropdown-active');
            });
        }
    });
});
</script>