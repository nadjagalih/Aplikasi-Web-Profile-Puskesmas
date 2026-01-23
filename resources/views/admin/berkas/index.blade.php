@extends('admin.layouts.app')

@section('title', 'Kelola Berkas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Kelola Berkas</h3>
                    <a href="{{ route('berkas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Berkas
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>File</th>
                                    <th>Ukuran</th>
                                    <th>Download</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berkas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $item->judul }}</strong>
                                            @if($item->deskripsi)
                                                <br><small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->kategori)
                                                <span class="badge text-bg-info p-2">{{ $item->kategori }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $ext = pathinfo($item->file_name, PATHINFO_EXTENSION);
                                                $iconClass = match($ext) {
                                                    'pdf' => 'fa-file-pdf text-danger',
                                                    'doc', 'docx' => 'fa-file-word text-primary',
                                                    'xls', 'xlsx' => 'fa-file-excel text-success',
                                                    'ppt', 'pptx' => 'fa-file-powerpoint text-warning',
                                                    'zip', 'rar' => 'fa-file-archive text-secondary',
                                                    default => 'fa-file text-muted'
                                                };
                                            @endphp
                                            <i class="fas {{ $iconClass }}"></i> 
                                            <span title="{{ $item->file_name }}">{{ Str::limit($item->file_name, 30) }}</span>
                                        </td>
                                        <td>{{ $item->file_size ?? '-' }}</td>
                                        <td><span class="badge text-bg-secondary p-2">{{ $item->download_count }}</span></td>
                                        <td>
                                            @if($item->status == 'Aktif')
                                                <span class="badge text-bg-success p-2">Aktif</span>
                                            @else
                                                <span class="badge text-bg-secondary p-2">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('berkas.edit', $item->id) }}" class="btn btn-warning mb-1">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mb-1">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('berkas.preview', $item->id) }}" class="btn btn-info mb-1" target="_blank" title="Lihat Berkas">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data berkas</td>
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
@endsection
