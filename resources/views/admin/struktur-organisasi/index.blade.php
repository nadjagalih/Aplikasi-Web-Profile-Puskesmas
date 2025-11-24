@extends('admin.layouts.main')

@section('content')


<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-header bg-primary">
        <div class="row align-items-center">
          <div class="col-6">
            <h5 class="card-title fw-semibold text-white">Struktur Organisasi</h5>
          </div>
        </div>
      </div>

      <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
        @endif

        <div class="row">
          <div class="button mb-3">
            <a href="/admin/struktur-organisasi/create" type="button" class="btn btn-success">Tambah Pegawai</a>
          </div>

          @php
            // Pisahkan kepala puskesmas dari yang lain
            $kepalaPuskesmas = $strukturOrganisasi->filter(function($item) {
              return stripos($item->jabatan, 'kepala puskesmas') !== false;
            })->first();
            
            $staffLainnya = $strukturOrganisasi->filter(function($item) {
              return stripos($item->jabatan, 'kepala puskesmas') === false;
            })->sortBy('jabatan');
          @endphp

          {{-- Tabel Kepala Puskesmas --}}
          @if($kepalaPuskesmas)
          <div class="col-12 mb-4">
            <h5 class="mb-3">Kepala Puskesmas</h5>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-primary">
                  <tr>
                    <th width="80" class="text-center">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th width="200" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center align-middle">
                      <img src="{{ asset('storage/' . $kepalaPuskesmas->foto) }}" 
                           class="img-thumbnail" 
                           alt="{{ $kepalaPuskesmas->nama }}" 
                           style="width: 60px; height: 60px; object-fit: cover;">
                    </td>
                    <td class="align-middle">
                      <strong>{{ $kepalaPuskesmas->nama }}</strong>
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-primary">{{ $kepalaPuskesmas->jabatan }}</span>
                    </td>
                    <td class="text-center align-middle">
                      <a href="/admin/struktur-organisasi/{{ $kepalaPuskesmas->id }}/edit" 
                         class="btn btn-sm btn-warning">
                        <i class="ti ti-edit"></i> Edit
                      </a>
                      <form id="delete-form-{{ $kepalaPuskesmas->id }}" 
                            action="/admin/struktur-organisasi/{{ $kepalaPuskesmas->id }}" 
                            method="POST" 
                            class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="button" 
                                class="btn btn-sm btn-danger swal-confirm" 
                                data-form="delete-form-{{ $kepalaPuskesmas->id }}">
                          <i class="ti ti-trash"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          @endif

          {{-- Tabel Staff Lainnya --}}
          @if($staffLainnya->count() > 0)
          <div class="col-12">
            <h5 class="mb-3">Staff & Pegawai</h5>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr>
                    <th width="50" class="text-center">No</th>
                    <th width="80" class="text-center">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th width="200" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($staffLainnya as $index => $perangkat)
                  <tr>
                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                    <td class="text-center align-middle">
                      <img src="{{ asset('storage/' . $perangkat->foto) }}" 
                           class="img-thumbnail" 
                           alt="{{ $perangkat->nama }}" 
                           style="width: 60px; height: 60px; object-fit: cover;">
                    </td>
                    <td class="align-middle">{{ $perangkat->nama }}</td>
                    <td class="align-middle">{{ $perangkat->jabatan }}</td>
                    <td class="text-center align-middle">
                      <a href="/admin/struktur-organisasi/{{ $perangkat->id }}/edit" 
                         class="btn btn-sm btn-warning">
                        <i class="ti ti-edit"></i> Edit
                      </a>
                      <form id="delete-form-{{ $perangkat->id }}" 
                            action="/admin/struktur-organisasi/{{ $perangkat->id }}" 
                            method="POST" 
                            class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="button" 
                                class="btn btn-sm btn-danger swal-confirm" 
                                data-form="delete-form-{{ $perangkat->id }}">
                          <i class="ti ti-trash"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @endif

        </div>

      </div>

    </div>
  </div>
</div>

@endsection