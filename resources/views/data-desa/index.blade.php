@extends('layouts.main')

@section('content')

<style>
    /* Styling for all section titles */
    .section-title h2 {
        color: #000;
        /* Sets the title color to black */
        text-align: center;
        /* Keeps the titles centered */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2rem;
        /* Font size for the titles */
        margin-bottom: 1.5rem;
        /* Space below the titles */
    }

    /* No other specific styles are changed here as per your request.
       Ensure other table/card styles are handled by your main CSS or Bootstrap. */
</style>

<section class="counts section-bg">
    <div class="container">

        {{-- DATA AGAMA --}}
        <div class="row my-4 justify-content-center">
            <div class="section-title text-center">
                <h2>Data Agama</h2>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Agama</th>
                                        <th>Penganut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataAgamas as $agama)
                                    <tr>
                                        <td>{{ $agama->agama }}</td>
                                        <td>{{ $agama->penganut }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-warning">
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ $totalPenganut }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        {{-- DATA JENIS KELAMIN --}}
        <div class="row my-4 justify-content-center">
            <div class="section-title text-center">
                <h2>Data Jenis Kelamin</h2>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataJenisKelamins as $jk)
                                    <tr>
                                        <td>{{ $jk->jenis_kelamin }}</td>
                                        <td>{{ $jk->jumlah }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-warning">
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ $jumlahTotal }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        {{-- DATA PEKERJAAN --}}
        <div class="row my-4 justify-content-center">
            <div class="section-title text-center">
                <h2>Data Pekerjaan</h2>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pekerjaans as $pekerjaan)
                                    <tr>
                                        <td>{{ $pekerjaan->pekerjaan }}</td>
                                        <td>{{ $pekerjaan->jumlah }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-warning">
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ $totalPekerjaan }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection