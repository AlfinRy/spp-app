@extends('layouts.admin.app')

@section('title', 'Tabel Siswa')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Siswa</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Table</div>
                </div> --}}
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                @if (session('level') === 'admin')
                                    <h4>
                                        <button type="button" data-toggle="modal" data-target="#modalTambahSiswa"
                                            class="btn rounded btn-success">Tambah Siswa
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
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataSiswa as $siswa)
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>{{ $siswa->nis }}</td>
                                                <td>{{ $siswa->nama }}</td>
                                                <td>{{ $siswa->jenis_kelamin }}</td>
                                                <td>{{ $siswa->kelas->nama_kelas }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalDetailSiswa-{{ $siswa->nis }}">
                                                        Detail
                                                    </button>
                                                    @if (session('level') === 'admin')
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modalEditSiswa-{{ $siswa->nis }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modalDeleteSiswa-{{ $siswa->nis }}">
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

        {{-- Modal Tambah Data Siswa --}}
        <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahSiswa">Tambah Siswa</h5>
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
                                            <label for="nis">NIS</label>
                                            <input type="text" name="nis" id="nis" class="form-control"
                                                placeholder="NIS">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="Nama">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="selectize">
                                                <option disabled hidden selected>Pilih !</option>
                                                @foreach ($jenisKelamin as $jk)
                                                    <option value="{{ $jk }}">
                                                        {{ $jk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="id_kelas">Kelas</label>
                                            <select name="id_kelas" id="id_kelas" class="selectize">
                                                <option disabled hidden selected>Pilih !</option>
                                                @foreach ($uniqueNamaKelas as $namaKelas)
                                                    <option value="{{ $namaKelas->id }}">
                                                        {{ $namaKelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="no_telp">No. Telp</label>
                                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                                placeholder="No. Telp">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" data-height="80"></textarea>
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


        {{-- Modal Detail Siswa --}}
        @foreach ($dataSiswa as $siswa)
            <div class="modal fade" id="modalDetailSiswa-{{ $siswa->nis }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDetailSiswaLabel-{{ $siswa->nis }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailSiswaLabel{{ $siswa->nis }}">Detail Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" id="nis" disabled
                                                    class="form-control" value="{{ $siswa->nis }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" disabled
                                                    class="form-control" value="{{ $siswa->username }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" disabled
                                                    class="form-control" value="{{ $siswa->nama }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <input type="text" name="jenis_kelamin" id="jenis_kelamin" disabled
                                                    class="form-control" value="{{ $siswa->jenis_kelamin }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="id_kelas">Kelas</label>
                                                <input type="text" name="nama" id="nama" disabled
                                                    class="form-control" value="{{ $siswa->kelas->nama_kelas }}">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="no_telp">No. Telp</label>
                                                <input type="text" name="no_telp" id="no_telp" disabled
                                                    class="form-control" value="{{ $siswa->no_telp }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" disabled class="form-control" data-height="80">{{ $siswa->alamat }}</textarea>
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

        {{-- Modal Edit Siswa --}}
        @foreach ($dataSiswa as $siswa)
            <div class="modal fade" id="modalEditSiswa-{{ $siswa->nis }}" tabindex="-1" role="dialog"
                aria-labelledby="modalEditSiswaLabel-{{ $siswa->nis }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditSiswaLabel{{ $siswa->nis }}">Edit Siswa</h5>
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
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" id="nis" class="form-control"
                                                    value="{{ $siswa->nis }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username"
                                                    class="form-control" value="{{ $siswa->username }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    value="{{ $siswa->nama }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jenis_kelamin">
                                                    Jenis Kelamin</label>
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="selectize">
                                                    <option disabled hidden selected>Pilih !</option>
                                                    @foreach ($jenisKelamin as $jk)
                                                        <option {{ $siswa->jenis_kelamin === $jk ? 'selected' : '' }}
                                                            value="{{ $jk }}">
                                                            {{ $jk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="id_kelas">Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="selectize">
                                                    <option disabled hidden selected>Pilih !</option>
                                                    @foreach ($uniqueNamaKelas as $namaKelas)
                                                        <option {{ $siswa->id_kelas === $namaKelas->id ? 'selected' : '' }}
                                                            value="{{ $namaKelas->id }}">
                                                            {{ $namaKelas->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="no_telp">No. Telp</label>
                                                <input type="text" name="no_telp" id="no_telp" class="form-control"
                                                    value="{{ $siswa->no_telp }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control" data-height="80">{{ $siswa->alamat }}</textarea>
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

        {{-- Modal Delete Siswa --}}
        @foreach ($dataSiswa as $siswa)
            <div class="modal fade" id="modalDeleteSiswa-{{ $siswa->nis }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDeleteSiswaLabel-{{ $siswa->nis }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('siswa.delete', $siswa->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteSiswaLabel{{ $siswa->nis }}">Delete Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus siswa <br>
                                    <b>{{ $siswa->nama }} ({{ $siswa->nis }})</b>
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
