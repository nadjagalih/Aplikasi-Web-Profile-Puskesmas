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
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="ti ti-heart-plus me-1"></i> Layanan Kesehatan
                                    </span>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="ti ti-mail me-1"></i> Kontak
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
                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            <i class="ti ti-database me-1"></i>
                            {{ $menus->count() }} Menu
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">

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
                                @forelse($menus as $index => $menu)
                                    <tr data-id="{{ $menu->id }}" data-position="{{ $menu->position }}" class="menu-row parent-menu">
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-circle px-2 py-1">{{ $index + 1 }}</span>
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
                                                        Parent Menu
                                                        @if($menu->children->count() > 0)
                                                            <span class="badge bg-info-subtle text-dark fw-semibold ms-1" style="font-size: 11px;">{{ $menu->children->count() }} submenu</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($menu->full_url)
                                                <span class="badge bg-light text-dark border">
                                                    <i class="ti ti-external-link me-1"></i>
                                                    {{ $menu->full_url }}
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
                                            <div class="form-check form-switch">
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
                                                            class="btn btn-sm btn-info shadow-sm add-submenu-btn" 
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
                                                                title="Buat Halaman"
                                                                onclick="createPageFromMenu({{ $menu->id }}, '{{ addslashes($menu->title) }}', '{{ $menu->slug }}', this)">
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
                                                            <small class="text-muted">Submenu</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($child->full_url)
                                                        <span class="badge bg-light text-dark border">
                                                            <i class="ti ti-external-link me-1"></i>
                                                            {{ $child->full_url }}
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
                                                <td>
                                                    <div class="form-check form-switch">
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
                                                                    title="Buat Halaman"
                                                                    onclick="createPageFromMenu({{ $child->id }}, '{{ addslashes($child->title) }}', '{{ $child->slug }}', this)">
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
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="ti ti-menu-2 fs-1 opacity-25 d-block mb-3"></i>
                                                <p class="fw-semibold mb-2">Belum ada menu tersedia</p>
                                                <small>Klik tombol "Tambah Menu" untuk membuat menu baru</small>
                                            </div>
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
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Session messages
    var successMessage = {!! json_encode(session('success')) !!};
    var errorMessage = {!! json_encode(session('error')) !!};

    // Show SweetAlert for success message
    if(successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage,
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    if(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: errorMessage,
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    // Delete confirmation with SweetAlert
    $(document).on('submit', '.delete-form', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Menu ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

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

    // Handle Add Submenu Modal
    $(document).on('click', '.add-submenu-btn', function() {
        const parentId = $(this).data('parent-id');
        $('#parent_id').val(parentId);
        $('#submenuForm')[0].reset();
        $('#parent_id').val(parentId); // Set again after reset
        $('#submenu_link_type').val('internal').trigger('change');
        $('#addSubmenuModal').modal('show');
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

    // Toggle Submenu Visibility
    $('.toggle-submenu').on('click', function() {
        const menuId = $(this).data('menu-id');
        const submenuRows = $('.submenu-' + menuId);
        const icon = $(this).find('.transition-icon');
        
        submenuRows.slideToggle(300);
        $(this).toggleClass('active');
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
