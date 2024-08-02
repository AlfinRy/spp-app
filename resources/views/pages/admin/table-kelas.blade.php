@extends('layouts.admin.app')

@section('title', 'Tabel Kelas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Kelas</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                @if (session('level') === 'admin')
                                    <h4>
                                        <button type="button" data-toggle="modal" data-target="#modalTambahKelas"
                                            class="btn rounded btn-success">Tambah Kelas
                                        </button>
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
                                            <th>Nama Kelas</th>
                                            <th>Nama Jurusan</th>
                                            <th>Jumlah Siswa</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataKelas as $kelas)
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>{{ $kelas->nama_kelas }}</td>
                                                <td>{{ $kelas->jurusan->nama_jurusan }}</td>
                                                <td>{{ $kelas->countSiswa() }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalDetailKelas-{{ $kelas->id }}">
                                                        Detail
                                                    </button>
                                                    @if (session('level') === 'admin')
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modalEditKelas-{{ $kelas->id }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modalDeleteKelas-{{ $kelas->id }}">
                                                            Delete
                                                        </button>
                                                    @endif
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

        {{-- Modal Tambah Data Kelas --}}
        <div class="modal fade" id="modalTambahKelas" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahKelas">Tambah Kelas</h5>
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
                                            <label for="nama_kelas">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control"
                                                placeholder="Nama Kelas">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="id_jurusan">Jurusan</label>
                                            <select name="id_jurusan" id="id_jurusan" class="selectize">
                                                <option disabled hidden selected>Pilih !</option>
                                                @foreach ($uniqueNamaJurusan as $namaJurusan)
                                                    <option value="{{ $namaJurusan->id }}">
                                                        {{ $namaJurusan->nama_jurusan }}</option>
                                                @endforeach
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


        {{-- Modal Detail Kelas --}}
        @foreach ($dataKelas as $kelas)
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
        @endforeach

        {{-- Modal Edit Kelas --}}
        @foreach ($dataKelas as $kelas)
            <div class="modal fade" id="modalEditKelas-{{ $kelas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalEditKelasLabel-{{ $kelas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKelasLabel{{ $kelas->nama_kelas }}">Edit
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
                                                <label for="nama_kelas">Nama Kelas</label>
                                                <input type="text" name="nama_kelas" id="nama_kelas"
                                                    class="form-control" value="{{ $kelas->nama_kelas }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                                <select name="id_jurusan" id="id_jurusan" class="selectize">
                                                    <option disabled hidden selected>Pilih !</option>
                                                    @foreach ($uniqueNamaJurusan as $namaJurusan)
                                                        <option value="{{ $namaJurusan->id }}">
                                                            {{ $namaJurusan->nama_jurusan }}</option>
                                                    @endforeach
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
        @endforeach

        {{-- Modal Delete Kelas --}}
        @foreach ($dataKelas as $kelas)
            <div class="modal fade" id="modalDeleteKelas-{{ $kelas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDeleteKelasLabel-{{ $kelas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('kelas.delete', $kelas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteKelasLabel{{ $kelas->id }}">Delete Kelas
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus kelas <br>
                                    <b>{{ $kelas->nama_kelas }} </b>
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
