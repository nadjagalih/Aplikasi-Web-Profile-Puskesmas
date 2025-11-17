@extends('admin.layouts.app')

@section('title', 'Kelola Agenda')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Agenda Kegiatan</h3>
                    <div class="card-tools">
                        <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Agenda
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Judul</th>
                                    <th width="18%">Tanggal Mulai</th>
                                    <th width="18%">Tanggal Selesai</th>
                                    <th width="20%">Tempat</th>
                                    <th width="9%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agendas as $index => $agenda)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $agenda->judul }}</td>
                                        <td>{{ $agenda->tanggal_mulai->format('d/m/Y H:i') }}</td>
                                        <td>{{ $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('d/m/Y H:i') : '-' }}</td>
                                        <td>{{ $agenda->tempat ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('agenda.edit', $agenda->id) }}" 
                                               class="btn btn-warning mb-1">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('agenda.destroy', $agenda->id) }}" 
                                                  method="POST" 
                                                  class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mb-1">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data agenda</td>
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

@push('styles')
<style>
    .color-box {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 2px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endpush
