<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img my-2">
                <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo" width="200">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <!-- DASHBOARD -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- TAMPILAN -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Tampilan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/slider" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo-minus"></i>
                        </span>
                        <span class="hide-menu">Slider</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/menu" aria-expanded="false">
                        <span>
                            <i class="ti ti-menu-2"></i>
                        </span>
                        <span class="hide-menu">Menu Website</span>
                    </a>
                </li>

                <!-- PROFIL PUSKESMAS -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Profil</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/sambutan" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-check"></i>
                        </span>
                        <span class="hide-menu">Sambutan Kepala</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/profilpkm" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Profil Puskesmas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/visi-misi" aria-expanded="false">
                        <span>
                            <i class="ti ti-target"></i>
                        </span>
                        <span class="hide-menu">Visi & Misi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/struktur-organisasi" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Struktur Organisasi</span>
                    </a>
                </li>

                <!-- INFORMASI -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Informasi</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Berita</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/berita" aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-point"></i>
                                </div>
                                <span class="hide-menu">Daftar Berita</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/kategori" aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-point"></i>
                                </div>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/pengumuman" aria-expanded="false">
                        <span>
                            <i class="ti ti-speakerphone"></i>
                        </span>
                        <span class="hide-menu">Pengumuman</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/agenda" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Agenda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/gallery" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Galeri</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/berkas" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-download"></i>
                        </span>
                        <span class="hide-menu">Berkas Download</span>
                    </a>
                </li>

                <!-- LAYANAN KESEHATAN -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Layanan Kesehatan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/layanan" aria-expanded="false">
                        <span>
                            <i class="ti ti-first-aid-kit"></i>
                        </span>
                        <span class="hide-menu">Jenis Layanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/alur-pelayanan" aria-expanded="false">
                        <span>
                            <i class="ti ti-git-branch"></i>
                        </span>
                        <span class="hide-menu">Alur Pelayanan</span>
                    </a>
                </li>

                <!-- KONTAK -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Kontak</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kontak" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail-forward"></i>
                        </span>
                        <span class="hide-menu">Info Kontak</span>
                    </a>
                </li>

                <!-- PENGATURAN -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengaturan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/identitas-situs" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-laravel"></i>
                        </span>
                        <span class="hide-menu">Identitas Situs</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/skm-config" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-laravel"></i>
                        </span>
                        <span class="hide-menu">Konfigurasi SKM</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/profil" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Profil Admin</span>
                    </a>
                </li>
            </ul>
        </nav><!-- End Sidebar navigation -->
    </div><!-- End Sidebar scroll-->
</aside>