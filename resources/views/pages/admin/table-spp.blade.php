@extends('layouts.admin.app')

@section('title', 'Table SPP')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
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
                                @if (session('level') === 'admin')
                                    <h4>
                                        <button type="button" data-toggle="modal" data-target="#modalTambahSpp"
                                            class="btn rounded btn-success">Tambah SPP
                                        </button>
                                    </h4>
                                    <h4>
                                        <a type="button" href="{{ route('spp.pdf') }}" target="_blank"
                                            class="btn rounded btn-primary">Buat
                                            Laporan
                                        </a>
                                    </h4>
                                @else
                                    <h4>

                                    </h4>
                                @endif
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
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataSpp as $spp)
                                            <?php if ($spp->tgl_transaksi !== null) {
                                                $date = DateTime::createFromFormat('Y-m-d', $spp->tgl_transaksi);
                                                $tgl_transaksi = $date->format('d M Y');
                                            } ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>{{ $spp->siswa->nama }}</td>
                                                <td>{{ $spp->siswa->kelas->nama_kelas }}</td>
                                                <td>{{ $spp->tgl_transaksi === null ? '-' : $tgl_transaksi }}</td>
                                                <td>{{ $spp->bulan }}</td>
                                                <td class="text-center">
                                                    @if ($spp->status === 'Sudah')
                                                        <button
                                                            class="btn {{ $spp->status === 'Sudah' ? 'btn-success' : 'btn-danger' }}">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-xmark"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="{{ $spp->status === 'Sudah' ? '#modalDetailSpp-' . $spp->id : '#modalBayarSpp-' . $spp->id }}">
                                                        {{ $spp->status === 'Sudah' ? 'Detail' : 'Bayar' }}
                                                    </button>

                                                    @if (session('level') === 'admin')
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modalEditSpp-{{ $spp->id }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modalDeleteSpp-{{ $spp->id }}">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
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
                                            <select name="id_siswa" id="id_siswa" class="selectize" required>
                                                <option disabled hidden selected>Pilih !</option>
                                                @foreach ($namaSiswa as $siswa)
                                                    <option value="{{ $siswa->id }}">
                                                        {{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bulan">SPP Bulan</label>
                                            <select name="bulan" id="bulan" class="selectize" required>
                                                <option disabled hidden selected>Pilih !</option>
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
        @foreach ($dataSpp as $spp)
            <div class="modal fade" id="modalBayarSpp-{{ $spp->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalBayarSpp-{{ $spp->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('spp.bayar', $spp->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalBayarSpp-{{ $spp->id }}">Bayar Spp</h5>
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
                                                    class="form-control"
                                                    value="<?= 'Rp ' . number_format($spp->nominal, 0, ',', '.') ?>">

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
        @endforeach

        {{-- Modal Detail Spp --}}
        @foreach ($dataSpp as $spp)
            <div class="modal fade" id="modalDetailSpp-{{ $spp->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDetailSpp-{{ $spp->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailSpp-{{ $spp->id }}">Detail Spp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-row">
                                            {{-- ID Petugas --}}
                                            <div class="form-group col-md-6">
                                                <label for="id_siswa">Nama Siswa</label>
                                                <input type="text" name="id_siswa" id="id_siswa" disabled
                                                    class="form-control" value="{{ $spp->siswa->nama }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="kelas">Kelas Siswa</label>
                                                <input type="text" name="kelas" id="kelas" disabled
                                                    class="form-control" value="{{ $spp->siswa->kelas->nama_kelas }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="id_petugas">Nama Petugas</label>
                                                <input type="text" name="id_petugas" id="id_petugas" disabled
                                                    class="form-control" value="{{ $spp->petugas->nama_petugas }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="bulan">SPP Bulan</label>
                                                <input type="text" disabled name="bulan" id="bulan"
                                                    class="form-control" value="{{ $spp->bulan }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nominal">Nominal</label>
                                                <input type="text" disabled name="nominal" id="nominal"
                                                    class="form-control"
                                                    value="<?= 'Rp ' . number_format($spp->nominal, 0, ',', '.') ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <input type="text" disabled name="status" id="status"
                                                    class="form-control" value="{{ $spp->status }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="total_bayar">Total Bayar</label>
                                                <input type="text" disabled name="total_bayar" id="total_bayar"
                                                    class="form-control"
                                                    value="<?= 'Rp ' . number_format($spp->total_bayar, 0, ',', '.') ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                                <input type="text" disabled name="tgl_transaksi" id="tgl_transaksi"
                                                    class="form-control"
                                                    value="<?= date_format(new DateTime($spp->tgl_transaksi), 'd-m-Y') ?>">
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
        @endforeach

        {{-- Modal Edit Spp --}}
        @foreach ($dataSpp as $spp)
            <div class="modal fade" id="modalEditSpp-{{ $spp->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalEditSppLabel-{{ $spp->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('spp.update', $spp->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalSppLabel{{ $spp->id }}">Edit
                                    Kelas</h5>
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
                                                <select name="id_siswa" id="id_siswa" class="selectize">
                                                    @foreach ($namaSiswa as $siswa)
                                                        <option {{ $spp->id_siswa === $siswa->id ? 'selected' : '' }}
                                                            value="{{ $siswa->id }}">
                                                            {{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="bulan">SPP Bulan</label>
                                                <select name="bulan" id="bulan" class="selectize">
                                                    @foreach ($namaBulan as $bulan)
                                                        <option {{ $spp->bulan === $bulan ? 'selected' : '' }}
                                                            value="{{ $bulan }}">
                                                            {{ $bulan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nominal">Nominal</label>
                                                <input type="text" disabled name="nominal" id="nominal"
                                                    class="form-control"
                                                    value="<?= 'Rp ' . number_format($spp->nominal, 0, ',', '.') ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <input type="text" disabled name="status" id="status"
                                                    class="form-control" value="{{ $spp->status }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                                <input type="date" name="tgl_transaksi" id="tgl_transaksi"
                                                    class="form-control" value="{{ $spp->tgl_transaksi }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="total_bayar">Total Bayar</label>
                                                <input type="text" disabled name="total_bayar" id="total_bayar"
                                                    class="form-control"
                                                    value="<?= 'Rp ' . number_format($spp->total_bayar, 0, ',', '.') ?>">
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
        @endforeach

        {{-- Modal Delete Spp --}}
        @foreach ($dataSpp as $spp)
            <div class="modal fade" id="modalDeleteSpp-{{ $spp->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDeleteSppLabel-{{ $spp->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('spp.delete', $spp->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteSppLabel{{ $spp->id }}">Delete Spp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus SPP <br>
                                    <b>{{ $spp->siswa->nama }} ({{ $spp->bulan }})</b>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        $(document).ready(function() {
            $('.selectize').selectize();
        });
    </script>
    <!-- Page Specific JS File -->
@endpush
