@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Galeri</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/admin/gallery/create" type="button" class="btn btn-warning float-end">Tambah
                            Galeri</a>
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
                    <div class="table-responsive">
                        <table id="table_id" class="table display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul Album</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Foto</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($albums as $album)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Album"
                                            class="img-fluid" style="max-height: 100px; max-width: 100px; object-fit: cover;"></td>
                                    <td>{{ $album->judul }}</td>
                                    <td>{{ Str::limit($album->deskripsi, 50) }}</td>
                                    <td>{{ $album->images->count() }} foto</td>
                                    <td>
                                        <a href="/admin/gallery/{{ $album->id }}" type="button"
                                            class="btn btn-info mb-1" title="Detail Album">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="/admin/gallery/{{ $album->id }}/edit" type="button"
                                            class="btn btn-warning mb-1" title="Edit Album">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $album->id }}" action="/admin/gallery/{{ $album->id }}"
                                            method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                data-form="delete-form-{{ $album->id }}" title="Hapus Album">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection