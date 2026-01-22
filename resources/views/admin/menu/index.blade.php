@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                Kelola Menu Website
            </h4>
            <p class="text-muted mb-0">Atur dan kelola menu navigasi website Anda</p>
        </div>
        <a href="{{ route('menu.create') }}" class="btn btn-primary shadow-sm">
            <i class="ti ti-plus me-1"></i> Tambah Menu
        </a>
    </div>

    <!-- Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="ti ti-info-circle fs-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-2">Menu Statis Sistem</h6>
                            <p class="mb-2 text-muted">Menu utama berikut dikelola oleh sistem dan tidak dapat diubah:</p>
                            <div class="row mt-3">
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="ti ti-home me-1"></i> Beranda
                                    </span>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="ti ti-user me-1"></i> Profil
                                    </span>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="ti ti-news me-1"></i> Informasi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-semibold mb-0">
                            <i class="ti ti-list text-primary me-2"></i>Daftar Menu
                        </h5>
                        @php
                            $totalDynamic = $dynamicMenus->count();
                            $totalStatic = 3; // Beranda, Profil, Informasi
                            $totalStaticSubmenus = 0;
                            foreach($staticMenus as $sm) {
                                $totalStaticSubmenus += $sm->children->count();
                            }
                            $totalMenus = $totalStatic + $totalStaticSubmenus + $totalDynamic;
                        @endphp
                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            <i class="ti ti-database me-1"></i>
                            {{ $totalMenus }} Menu Total ({{ $totalStatic }} Statis + {{ $totalStaticSubmenus }} Submenu + {{ $totalDynamic }} Dinamis)
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            <i class="ti ti-check me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <i class="ti ti-x me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="menuTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%" class="text-center">
                                        <i class="ti ti-hash"></i>
                                    </th>
                                    <th width="28%">
                                        <i class="ti ti-file-text me-1"></i>Judul Menu
                                    </th>
                                    <th width="22%">
                                        <i class="ti ti-link me-1"></i>URL
                                    </th>
                                    <th width="13%" class="text-center">
                                        <i class="ti ti-category me-1"></i>Tipe
                                    </th>
                                    <th width="8%" class="text-center">
                                        <i class="ti ti-arrows-sort me-1"></i>Urutan
                                    </th>
                                    <th width="10%" class="text-center">
                                        <i class="ti ti-toggle-left me-1"></i>Status
                                    </th>
                                    <th width="14%" class="text-center">
                                        <i class="ti ti-settings me-1"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sortable-menu">
                                {{-- Menu Statis --}}
                                @php
                                    $displayStaticMenus = [
                                        ['title' => 'Beranda', 'slug' => 'beranda', 'icon' => 'ti ti-home', 'url' => '/', 'order' => 10],
                                        ['title' => 'Profil', 'slug' => 'profil', 'icon' => 'ti ti-user', 'url' => '#', 'order' => 20, 'type' => 'dropdown'],
                                        ['title' => 'Informasi', 'slug' => 'informasi', 'icon' => 'ti ti-news', 'url' => '#', 'order' => 30, 'type' => 'dropdown'],
                                    ];
                                @endphp
                                
                                @foreach($displayStaticMenus as $index => $displayMenu)
                                    @php
                                        $staticMenu = $staticMenus->firstWhere('slug', $displayMenu['slug']);
                                        $hasChildren = $staticMenu && $staticMenu->children->count() > 0;
                                    @endphp
                                    <tr class="menu-row parent-menu table-secondary">
                                        <td class="text-center">
                                            <span class="badge bg-secondary rounded-circle px-2 py-1">{{ $index + 1 }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($displayMenu['type']) && $displayMenu['type'] === 'dropdown')
                                                    <button class="btn btn-sm btn-link p-0 me-2 toggle-submenu" 
                                                            data-menu-id="static-{{ $displayMenu['slug'] }}"
                                                            type="button">
                                                        <i class="ti ti-chevron-right transition-icon"></i>
                                                    </button>
                                                @endif
                                                @if($displayMenu['icon'])
                                                    <div class="icon-box bg-secondary bg-opacity-25 text-secondary rounded me-2 p-2">
                                                        <i class="{{ $displayMenu['icon'] }}"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong class="d-block fw-bold text-dark">{{ $displayMenu['title'] }}</strong>
                                                    <small class="text-muted">
                                                        <span class="badge bg-secondary-subtle text-dark" style="font-size: 11px;">Menu Statis Sistem</span>
                                                        @if($hasChildren)
                                                            <span class="badge bg-info-subtle text-dark fw-semibold ms-1" style="font-size: 11px;">
                                                                {{ $staticMenu->children->count() }} submenu
                                                            </span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="ti ti-link me-1"></i>
                                                {{ $displayMenu['url'] }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary fw-semibold">Statis</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary-subtle text-dark fw-bold px-3 py-2">{{ $displayMenu['order'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success">
                                                <i class="ti ti-check me-1"></i>Aktif
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if(isset($displayMenu['type']) && $displayMenu['type'] === 'dropdown')
                                                <button type="button" 
                                                        class="btn btn-sm btn-info shadow-sm btn-add-submenu" 
                                                        data-parent-id="{{ $staticMenu ? $staticMenu->id : '' }}"
                                                        data-parent-slug="{{ $displayMenu['slug'] }}"
                                                        data-parent-title="{{ $displayMenu['title'] }}"
                                                        data-parent-url="{{ $displayMenu['url'] }}"
                                                        data-parent-order="{{ $displayMenu['order'] }}"
                                                        data-bs-toggle="tooltip"
                                                        title="Tambah Submenu ke {{ $displayMenu['title'] }}">
                                                    <i class="ti ti-plus"></i> Submenu
                                                </button>
                                            @else
                                                <span class="badge bg-secondary-subtle text-dark">
                                                    <i class="ti ti-lock me-1"></i>Tidak dapat diedit
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    {{-- Submenu Statis yang hardcoded --}}
                                    @if(isset($displayMenu['type']) && $displayMenu['type'] === 'dropdown')
                                        @php
                                            // Define static submenus
                                            $staticSubmenus = [];
                                            if($displayMenu['slug'] === 'profil') {
                                                $staticSubmenus = [
                                                    ['title' => 'Sambutan', 'url' => '/sambutan', 'order' => 1],
                                                    ['title' => 'Profil Puskesmas', 'url' => '/profil-puskesmas', 'order' => 2],
                                                    ['title' => 'Visi & Misi', 'url' => '/visi-misi', 'order' => 3],
                                                    ['title' => 'Struktur Organisasi', 'url' => '/struktur-organisasi', 'order' => 4],
                                                ];
                                            } elseif($displayMenu['slug'] === 'informasi') {
                                                $staticSubmenus = [
                                                    ['title' => 'Berita', 'url' => '/berita', 'order' => 1],
                                                    ['title' => 'Pengumuman', 'url' => '/pengumuman', 'order' => 2],
                                                    ['title' => 'Agenda', 'url' => '/agenda', 'order' => 3],
                                                    ['title' => 'Gallery', 'url' => '/gallery', 'order' => 4],
                                                    ['title' => 'Berkas', 'url' => '/berkas', 'order' => 5],
                                                ];
                                            }
                                        @endphp
                                        
                                        {{-- Display static submenus first --}}
                                        @foreach($staticSubmenus as $staticSub)
                                            <tr class="submenu-static-{{ $displayMenu['slug'] }} child-menu bg-secondary bg-opacity-10" style="display: none;">
                                                <td class="text-center">
                                                    <i class="ti ti-lock text-secondary" data-bs-toggle="tooltip" title="Submenu Statis Sistem"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center ps-4">
                                                        <i class="ti ti-corner-down-right text-secondary me-2"></i>
                                                        <div>
                                                            <strong class="d-block text-dark">{{ $staticSub['title'] }}</strong>
                                                            <small class="text-muted">
                                                                <span class="badge bg-secondary-subtle text-dark" style="font-size: 10px;">
                                                                    <i class="ti ti-lock me-1"></i>Submenu Statis Sistem
                                                                </span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border">
                                                        <i class="ti ti-link me-1"></i>{{ $staticSub['url'] }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary fw-semibold">Statis</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark">{{ $staticSub['order'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-success">
                                                        <i class="ti ti-check me-1"></i>Aktif
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary-subtle text-dark">
                                                        <i class="ti ti-lock me-1"></i>Tidak dapat diedit
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                    {{-- Submenu dinamis untuk menu statis (dari tabel menus) --}}
                                    @if($hasChildren)
                                        @foreach($staticMenu->children as $submenu)
                                            <tr class="submenu-static-{{ $displayMenu['slug'] }} child-menu" style="display: none;">
                                                <td></td>
                                                <td>
                                                    <div class="d-flex align-items-center ps-4">
                                                        <i class="ti ti-corner-down-right text-muted me-2"></i>
                                                        <div>
                                                            <strong class="d-block text-dark">{{ $submenu->title }}</strong>
                                                            <small class="text-muted">
                                                                <span class="badge bg-info-subtle text-dark" style="font-size: 10px;">
                                                                    <i class="ti ti-database me-1"></i>Submenu Dinamis
                                                                </span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border">{{ Str::limit($submenu->url, 25) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-{{ $submenu->type === 'parent_only' ? 'success' : 'info' }}-subtle text-dark">
                                                        {{ $submenu->type === 'parent_only' ? 'Halaman' : 'Parent' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark">{{ $submenu->order }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input toggle-status" 
                                                               type="checkbox" 
                                                               data-id="{{ $submenu->id }}"
                                                               {{ $submenu->is_active ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('menu.edit', $submenu) }}" 
                                                           class="btn btn-sm btn-warning shadow-sm"
                                                           data-bs-toggle="tooltip"
                                                           title="Edit Menu">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        
                                                        @if($submenu->page)
                                                            <a href="{{ route('pages.edit', $submenu->page->id) }}" 
                                                               class="btn btn-sm btn-success shadow-sm"
                                                               data-bs-toggle="tooltip"
                                                               title="Edit Halaman">
                                                                <i class="ti ti-file-text"></i>
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                    class="btn btn-sm btn-primary shadow-sm create-page-btn"
                                                                    data-menu-id="{{ $submenu->id }}"
                                                                    data-menu-title="{{ $submenu->title }}"
                                                                    data-menu-slug="{{ $submenu->slug }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Buat Halaman">
                                                                <i class="ti ti-file-plus"></i>
                                                            </button>
                                                        @endif
                                                        
                                                        <form action="{{ route('menu.destroy', $submenu) }}" 
                                                              method="POST" 
                                                              class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-danger shadow-sm" 
                                                                    data-bs-toggle="tooltip"
                                                                    title="Hapus">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                
                                {{-- Menu Dinamis --}}
                                @forelse($dynamicMenus as $index => $menu)
                                    <tr data-id="{{ $menu->id }}" data-position="{{ $menu->position }}" class="menu-row parent-menu">
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-circle px-2 py-1">D{{ $index + 1 }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($menu->children->count() > 0)
                                                    <button class="btn btn-sm btn-link p-0 me-2 toggle-submenu" 
                                                            data-menu-id="{{ $menu->id }}"
                                                            type="button">
                                                        <i class="ti ti-chevron-right transition-icon"></i>
                                                    </button>
                                                @endif
                                                @if($menu->icon)
                                                    <div class="icon-box bg-primary-subtle text-primary rounded me-2 p-2">
                                                        <i class="{{ $menu->icon }}"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong class="d-block fw-bold text-dark">{{ $menu->title }}</strong>
                                                    <small class="text-muted">
                                                        <span class="badge bg-primary-subtle text-dark" style="font-size: 11px;">Menu Dinamis</span>
                                                        @if($menu->children->count() > 0)
                                                            <span class="badge bg-info-subtle text-dark fw-semibold ms-1" style="font-size: 11px;">{{ $menu->children->count() }} submenu</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($menu->url)
                                                <span class="badge bg-light text-dark border">
                                                    <i class="ti ti-link me-1"></i>
                                                    {{ Str::limit($menu->url, 25) }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($menu->type === 'parent_with_sub')
                                                <span class="badge bg-info-subtle text-dark fw-semibold">Parent with Sub</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-dark fw-semibold">Parent Only</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary-subtle text-dark fw-bold px-3 py-2">{{ $menu->order }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input toggle-status" 
                                                       type="checkbox" 
                                                       data-id="{{ $menu->id }}"
                                                       {{ $menu->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('menu.edit', $menu->id) }}" 
                                                   class="btn btn-sm btn-warning shadow-sm"
                                                   data-bs-toggle="tooltip"
                                                   title="Edit Menu">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                
                                                @if($menu->type === 'parent_with_sub')
                                                    {{-- Menu type is parent_with_sub: show "Add Submenu" button --}}
                                                    <button type="button" 
                                                            class="btn btn-sm btn-info shadow-sm btn-add-submenu" 
                                                            data-parent-id="{{ $menu->id }}"
                                                            data-bs-toggle="tooltip"
                                                            title="Tambah Submenu">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                @else
                                                    {{-- Menu type is parent_only: show page button (Edit or Create) --}}
                                                    @if($menu->page)
                                                        <a href="{{ route('pages.edit', $menu->page->id) }}" 
                                                           class="btn btn-sm btn-success shadow-sm"
                                                           data-bs-toggle="tooltip"
                                                           title="Edit Halaman">
                                                            <i class="ti ti-file-text"></i>
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                                class="btn btn-sm btn-primary shadow-sm create-page-btn"
                                                                data-menu-id="{{ $menu->id }}"
                                                                data-menu-title="{{ $menu->title }}"
                                                                data-menu-slug="{{ $menu->slug }}"
                                                                data-bs-toggle="tooltip"
                                                                title="Buat Halaman">
                                                            <i class="ti ti-file-plus"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                                
                                                <form action="{{ route('menu.destroy', $menu->id) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger shadow-sm" 
                                                            data-bs-toggle="tooltip"
                                                            title="Hapus Menu">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    @if($menu->children->count() > 0)
                                        @foreach($menu->children as $child)
                                            <tr data-id="{{ $child->id }}" 
                                                data-position="{{ $child->position }}" 
                                                class="menu-row child-menu submenu-row submenu-{{ $menu->id }}" 
                                                style="display: none;">
                                                <td class="text-center bg-primary-subtle">
                                                    <i class="ti ti-corner-down-right text-primary"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center ps-4">
                                                        @if($child->icon)
                                                            <div class="icon-box bg-info-subtle text-info rounded me-2 p-2">
                                                                <i class="{{ $child->icon }}"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <span class="d-block fw-semibold text-dark">{{ $child->title }}</span>
                                                            <small class="text-muted">Submenu Dinamis</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($child->url)
                                                        <span class="badge bg-light text-dark border">
                                                            <i class="ti ti-link me-1"></i>
                                                            {{ Str::limit($child->url, 25) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted fst-italic">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-info-subtle text-dark fw-semibold">Submenu</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary-subtle text-dark fw-bold px-3 py-2">
                                                        {{ $menu->order }}.{{ $loop->iteration }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input toggle-status" 
                                                               type="checkbox" 
                                                               data-id="{{ $child->id }}"
                                                               {{ $child->is_active ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('menu.edit', $child->id) }}" 
                                                           class="btn btn-sm btn-warning shadow-sm"
                                                           data-bs-toggle="tooltip"
                                                           title="Edit Menu">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        
                                                        {{-- Always show page button: Edit if exists, Create if not --}}
                                                        @if($child->page)
                                                            <a href="{{ route('pages.edit', $child->page->id) }}" 
                                                               class="btn btn-sm btn-success shadow-sm"
                                                               data-bs-toggle="tooltip"
                                                               title="Edit Halaman">
                                                                <i class="ti ti-file-text"></i>
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                    class="btn btn-sm btn-primary shadow-sm create-page-btn"
                                                                    data-menu-id="{{ $child->id }}"
                                                                    data-menu-title="{{ $child->title }}"
                                                                    data-menu-slug="{{ $child->slug }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Buat Halaman">
                                                                <i class="ti ti-file-plus"></i>
                                                            </button>
                                                        @endif
                                                        
                                                        <form action="{{ route('menu.destroy', $child->id) }}" 
                                                              method="POST" 
                                                              class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-danger shadow-sm" 
                                                                    data-bs-toggle="tooltip"
                                                                    title="Hapus">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="ti ti-folder-off fs-1 mb-3 d-block"></i>
                                            <p class="mb-0">Tidak ada menu dinamis. Klik tombol "Tambah Menu" untuk membuat menu baru.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Submenu -->
<div class="modal fade" id="addSubmenuModal" tabindex="-1" aria-labelledby="addSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addSubmenuModalLabel">Tambah Submenu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submenuForm" action="{{ route('menu.store') }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" id="parent_id">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="submenu_title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="submenu_title" 
                               name="title" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="submenu_slug" class="form-label">Slug</label>
                        <input type="text" 
                               class="form-control" 
                               id="submenu_slug" 
                               name="slug" 
                               readonly>
                        <small class="text-muted">Slug akan dibuat otomatis dari judul</small>
                    </div>

                    <div class="mb-3">
                        <label for="submenu_link_type" class="form-label">Tipe Link <span class="text-danger">*</span></label>
                        <select class="form-select" id="submenu_link_type" name="link_type" required>
                            <option value="internal" selected>Internal (Halaman dalam website)</option>
                            <option value="external">External (Link ke website lain)</option>
                        </select>
                    </div>

                    <div class="mb-3" id="submenu_url_field">
                        <label for="submenu_url" class="form-label">URL</label>
                        <input type="text" 
                               class="form-control" 
                               id="submenu_url" 
                               name="url"
                               placeholder="Contoh: https://example.com">
                        <small class="text-muted">URL akan otomatis diisi untuk link internal</small>
                    </div>

                    <div class="mb-3">
                        <label for="submenu_order" class="form-label">Urutan</label>
                        <input type="number" 
                               class="form-control" 
                               id="submenu_order" 
                               name="order" 
                               value="0" 
                               min="0">
                    </div>

                    <input type="hidden" name="type" value="parent_only">
                    <input type="hidden" name="position" value="header">
                    <input type="hidden" name="target" id="submenu_target" value="_self">
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="create_page" id="submenu_create_page" value="1">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Submenu</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Card Styling */
.card {
    transition: all 0.3s ease;
}

/* Icon Box */
.icon-box {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

/* Toggle Submenu Button */
.toggle-submenu {
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.toggle-submenu:hover {
    color: #495057;
}

.toggle-submenu .transition-icon {
    transition: transform 0.3s ease;
    font-size: 18px;
}

.toggle-submenu.active .transition-icon {
    transform: rotate(90deg);
}

/* Submenu Rows */
.submenu-row {
    transition: all 0.3s ease;
}

/* Table Styling */
#menuTable {
    margin-bottom: 0;
}

#menuTable thead th {
    background-color: #f8f9fa;
    color: #212529;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #dee2e6;
    padding: 16px 12px;
    vertical-align: middle;
}

#menuTable tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f0f0f0;
}

#menuTable tbody tr:hover {
    background-color: #f8f9fa;
}

#menuTable tbody tr.child-menu {
    background-color: #f8f9fa;
}

#menuTable tbody tr.child-menu:hover {
    background-color: #e9ecef;
}

#menuTable td {
    padding: 14px 12px;
    vertical-align: middle;
    border: none;
    color: #212529;
    font-weight: 500;
}

/* Button Styling */
.btn {
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-group-sm .btn,
.btn-group .btn-sm {
    padding: 8px 12px;
    font-size: 14px;
    line-height: 1.2;
    min-width: 38px;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-group-sm .btn i,
.btn-group .btn-sm i {
    font-size: 16px;
}

/* Ensure btn-group buttons are aligned */
.btn-group {
    display: inline-flex;
    align-items: stretch;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.btn-group .btn:last-child,
.btn-group form:last-child .btn {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

/* Badge Styling */
.badge {
    font-weight: 600;
    padding: 6px 12px;
}

.badge.bg-light {
    color: #212529 !important;
    font-weight: 600;
}
/* Toggle Switch */
.form-check-input {
    width: 2.5em;
    height: 1.3em;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

/* Shadow Utilities */
.shadow-sm {
    box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    
    .icon-box {
        width: 32px;
        height: 32px;
        font-size: 16px;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.menu-row {
    animation: fadeIn 0.3s ease-in-out;
}
</style>
@endpush

@push('scripts')
<script>
// Global function untuk open submenu modal (dipanggil dari onclick)
function openAddSubmenuModal(parentId) {
    console.log('Opening submenu modal for parent ID:', parentId);
    
    // Reset form
    const form = document.getElementById('submenuForm');
    if (form) {
        form.reset();
        
        // Hapus hidden fields auto_create_parent jika ada
        $('#submenuForm input[name="auto_create_parent"]').remove();
        $('#submenuForm input[name="parent_slug"]').remove();
        $('#submenuForm input[name="parent_title"]').remove();
        $('#submenuForm input[name="parent_url"]').remove();
        $('#submenuForm input[name="parent_order"]').remove();
    }
    
    // Set parent ID
    const parentInput = document.getElementById('parent_id');
    if (parentInput) {
        parentInput.value = parentId;
    }
    
    // Set link type to internal
    const linkTypeSelect = document.getElementById('submenu_link_type');
    if (linkTypeSelect) {
        linkTypeSelect.value = 'internal';
        $(linkTypeSelect).trigger('change');
    }
    
    // Show modal
    const modalElement = document.getElementById('addSubmenuModal');
    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    } else {
        alert('Error: Modal tidak ditemukan!');
    }
}

// Global function untuk create page (dipanggil dari onclick)
function createPageFromMenu(menuId, menuTitle, menuSlug, button) {
    const $button = $(button);
    
    Swal.fire({
        title: 'Buat Halaman Baru?',
        text: 'Akan membuat halaman baru untuk menu "' + menuTitle + '"',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Buat!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $button.prop('disabled', true).html('<i class="ti ti-loader"></i>');
            
            $.ajax({
                url: '/admin/pages/create-from-menu',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    menu_id: menuId,
                    title: menuTitle,
                    slug: menuSlug
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Halaman berhasil dibuat!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/admin/pages/' + response.page_id + '/edit';
                        });
                    }
                },
                error: function(xhr) {
                    $button.prop('disabled', false).html('<i class="ti ti-file-plus"></i>');
                    let errorMsg = 'Gagal membuat halaman!';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMsg,
                        showConfirmButton: true
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    // Function to initialize tooltips
    function initTooltips() {
        // Dispose existing tooltips first
        var existingTooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        existingTooltips.forEach(function(el) {
            var tooltip = bootstrap.Tooltip.getInstance(el);
            if (tooltip) {
                tooltip.dispose();
            }
        });
        
        // Initialize new tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Initialize tooltips on page load
    initTooltips();

    // Toggle Status
    $('.toggle-status').change(function() {
        const menuId = $(this).data('id');
        const isChecked = $(this).is(':checked');
        const checkbox = $(this);
        
        $.ajax({
            url: '/admin/menu/' + menuId + '/toggle',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Status menu berhasil diubah',
                        timer: 2000,
                        showConfirmButton: false,
                        position: 'top-end',
                        toast: true
                    });
                }
            },
            error: function() {
                // Revert checkbox on error
                checkbox.prop('checked', !isChecked);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengubah status menu',
                    timer: 2000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            }
        });
    });

    // Handle Add Submenu button click (using data attribute)
    $(document).on('click', '.btn-add-submenu', function(e) {
        e.preventDefault();
        const $btn = $(this);
        const parentId = $btn.data('parent-id');
        
        // Jika parent belum ada (ID kosong), buat dulu parent-nya
        if (!parentId || parentId === '') {
            const parentSlug = $btn.data('parent-slug');
            const parentTitle = $btn.data('parent-title');
            const parentUrl = $btn.data('parent-url');
            const parentOrder = $btn.data('parent-order');
            
            // Simpan data untuk submenu modal
            window.pendingSubmenuData = {
                slug: parentSlug,
                title: parentTitle,
                url: parentUrl,
                order: parentOrder
            };
            
            // Set flag bahwa ini untuk static parent
            $('#submenuForm').append('<input type="hidden" name="auto_create_parent" value="1">');
            $('#submenuForm').append('<input type="hidden" name="parent_slug" value="' + parentSlug + '">');
            $('#submenuForm').append('<input type="hidden" name="parent_title" value="' + parentTitle + '">');
            $('#submenuForm').append('<input type="hidden" name="parent_url" value="' + parentUrl + '">');
            $('#submenuForm').append('<input type="hidden" name="parent_order" value="' + parentOrder + '">');
            
            openAddSubmenuModal('');
        } else {
            // Parent sudah ada, langsung buka modal
            openAddSubmenuModal(parentId);
        }
    });

    // Handle submenu link type change
    $('#submenu_link_type').on('change', function() {
        const linkType = $(this).val();
        const $urlField = $('#submenu_url');
        const $slugField = $('#submenu_slug');
        const $targetField = $('#submenu_target');
        const $createPageField = $('#submenu_create_page');
        
        if (linkType === 'external') {
            // External link: show URL field, set target to _blank, disable page creation
            $urlField.prop('readonly', false)
                     .prop('required', true)
                     .val('')
                     .attr('placeholder', 'Contoh: https://example.com');
            $urlField.closest('.mb-3').find('small').text('Masukkan URL lengkap dengan https://');
            $slugField.prop('readonly', false); // Allow manual slug for external
            $targetField.val('_blank');
            $createPageField.val('0');
        } else {
            // Internal link: URL auto-generated from slug, set target to _self, enable page creation
            $urlField.prop('readonly', true)
                     .prop('required', false)
                     .val('')
                     .attr('placeholder', 'URL akan otomatis diisi dari slug');
            $urlField.closest('.mb-3').find('small').text('URL akan otomatis diisi untuk link internal');
            $slugField.prop('readonly', true);
            $targetField.val('_self');
            $createPageField.val('1');
        }
    });
    
    // Update slug when title changes
    $('#submenu_title').on('keyup', function() {
        const title = $(this).val();
        $.ajax({
            url: '/admin/menu/slug',
            type: 'GET',
            data: { title: title },
            success: function(response) {
                $('#submenu_slug').val(response.slug);
            }
        });
    });

    // Trigger change on page load to set initial state
    $('#submenu_link_type').trigger('change');

    // Handle Create Static Parent Menu button
    // Handle Create Page From Menu button
    $(document).on('click', '.create-page-btn', function() {
        const menuId = $(this).data('menu-id');
        const menuTitle = $(this).data('menu-title');
        const menuSlug = $(this).data('menu-slug');
        const button = $(this);
        
        createPageFromMenu(menuId, menuTitle, menuSlug, button[0]);
    });

    // Toggle Submenu Visibility
    $('.toggle-submenu').on('click', function() {
        const menuId = String($(this).data('menu-id')); // Convert to string
        console.log('Toggle clicked, menuId:', menuId, 'type:', typeof menuId);
        
        // Support dynamic menu submenu, static menu submenu, and custom menu submenu
        let submenuRows;
        if (menuId.startsWith('static-')) {
            // Static menu (profil, informasi)
            const staticSlug = menuId.replace('static-', '');
            submenuRows = $('.submenu-static-' + staticSlug);
            console.log('Static menu, selector: .submenu-static-' + staticSlug, 'Found:', submenuRows.length);
        } else if (menuId.startsWith('custom-')) {
            // Custom menu
            const customId = menuId.replace('custom-', '');
            submenuRows = $('.submenu-custom-' + customId);
            console.log('Custom menu, selector: .submenu-custom-' + customId, 'Found:', submenuRows.length);
        } else {
            // Dynamic menu (numeric ID)
            submenuRows = $('.submenu-' + menuId);
            console.log('Dynamic menu, selector: .submenu-' + menuId, 'Found:', submenuRows.length);
        }
        
        const icon = $(this).find('.transition-icon');
        
        if (submenuRows.length > 0) {
            submenuRows.slideToggle(300);
            $(this).toggleClass('active');
            console.log('Toggled submenu visibility');
        } else {
            console.log('No submenu rows found!');
        }
    });
    
    // Update URL when title changes (for internal links only)
    $('#submenu_title').on('keyup', function() {
        const linkType = $('#submenu_link_type').val();
        if (linkType === 'internal') {
            const title = $(this).val();
            $.ajax({
                url: '/admin/menu/slug',
                type: 'GET',
                data: { title: title },
                success: function(response) {
                    $('#submenu_slug').val(response.slug);
                }
            });
        }
    });

    // Trigger change on page load to set initial state
    $('#submenu_link_type').trigger('change');
});
</script>
@endpush
@endsection
