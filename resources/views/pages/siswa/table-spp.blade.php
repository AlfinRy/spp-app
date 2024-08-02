@extends('layouts.admin.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    function rupiah($angka)
    {
    $hasil_rp = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil_rp;
    }
    ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data SPP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <button type="button" data-toggle="modal" data-target="#modalTambahSpp"
                                        class="btn rounded btn-success">Tambah SPP
                                    </button>
                                </h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-bordered table">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>SPP Bulan</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataSpp as $spp)
                                            <?php $date = date_format(new DateTime($spp->tgl_transaki), 'd M Y'); ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>{{ $spp->siswa->nama }}</td>
                                                <td>{{ $spp->siswa->kelas->nama_kelas }}</td>
                                                <td>{{ $date ? $date : '-' }}</td>
                                                <td>{{ $spp->bulan }}</td>
                                                <td>{{ $spp->status }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalBayarSpp-{{ $spp->id }}">
                                                        Bayar
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modalEditSpp-{{ $spp->id }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modalDeleteSpp-{{ $spp->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Modal Tambah Data Spp --}}
        <div class="modal fade" id="modalTambahSpp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('spp.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahSpp">Tambah Sppp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        {{-- ID Petugas --}}
                                        <input type="hidden" name="id_user" class="form-control" id="id_user"
                                            value="{{ session('id') }}">
                                        <div class="form-group col-md-6">
                                            <label for="id_siswa">Nama Siswa</label>
                                            <select name="id_siswa" id="id_siswa" class="form-control">
                                                <option hidden selected>Pilih !</option>
                                                @foreach ($namaSiswa as $siswa)
                                                    <option value="{{ $siswa->id }}">
                                                        {{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bulan">SPP Bulan</label>
                                            <select name="bulan" id="bulan" class="form-control chosen-select">
                                                <option hidden selected>Pilih !</option>
                                                @foreach ($namaBulan as $bulan)
                                                    <option value="<?= $bulan ?>">
                                                        <?= $bulan ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nominal">Nominal</label>
                                            <input type="text" name="nominal" id="nominal" class="form-control"
                                                value="{{ $spp->nominal }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option hidden selected>Pilih !</option>
                                                <option value="Belum">Belum</option>
                                                <option value="Sudah">Sudah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Bayar Spp --}}
        <div class="modal fade" id="modalBayarSpp-{{ $spp->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalBayarSpp-{{ $spp->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('spp.bayar', $spp->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahSpp">Bayar Spp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        {{-- ID Petugas --}}
                                        <input type="hidden" name="id_user" class="form-control" id="id_user"
                                            value="{{ session('id') }}">
                                        <div class="form-group col-md-6">
                                            <label for="id_siswa">Nama Siswa</label>
                                            <input type="text" name="id_siswa" id="id_siswa" disabled
                                                class="form-control"
                                                value="{{ $spp->siswa->nama }} - {{ $spp->siswa->kelas->nama_kelas }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bulan">SPP Bulan</label>
                                            <input type="text" disabled name="bulan" id="bulan"
                                                class="form-control" value="{{ $spp->bulan }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nominal">Nominal</label>
                                            <input type="text" disabled name="nominal" id="nominal"
                                                class="form-control" value="{{ $spp->nominal }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option hidden selected>Pilih !</option>
                                                @foreach ($namaStatus as $status)
                                                    <option {{ $spp->status === $status ? 'selected' : '' }}
                                                        value="{{ $status }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tgl_transaksi">Tanggal Transaksi</label>
                                            <input type="date" name="tgl_transaksi" id="tgl_transaksi"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="total_bayar">Total Bayar</label>
                                            <input type="text" name="total_bayar" id="total_bayar"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Modal Detail Kelas --}}
        {{-- @foreach ($dataKelas as $kelas)
            <div class="modal fade" id="modalDetailKelas-{{ $kelas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDetailKelasLabel-{{ $kelas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailKelasLabel{{ $kelas->id }}">Detail Kelas
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_kelas">Nama Kelas</label>
                                                <input type="text" name="nama_kelas" id="nama_kelas" disabled
                                                    class="form-control" value="{{ $kelas->nama_kelas }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian"
                                                    disabled class="form-control"
                                                    value="{{ $kelas->kompetensi_keahlian }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach --}}

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
