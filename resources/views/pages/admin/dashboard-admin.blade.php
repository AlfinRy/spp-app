@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Siswa</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSiswa }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-user-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Kelas</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKelas }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-users-line"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Jurusan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalProdi }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-hourglass"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Transaksi Bulan Ini</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahTransaksi }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Belum Lunas</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahBelumLunas }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-credit-card"></i>
                            {{-- <i class="fa-regular fa-wallet"></i> --}}
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Saldo</h4>
                            </div>
                            <div class="card-body">
                                <?= 'Rp ' . number_format($jumlahSaldo, 0, ',', '.') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="hero bg-primary text-white">
                        <div class="hero-inner">
                            <h2>Selamat Datang,
                                {{ session('user')['username'] }}
                                !</h2>
                            <p class="lead">Ini merupakan tampilan Dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
