@extends('layouts.admin.app')

@section('title', 'Tabel Kelas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Jurusan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <button type="button" data-toggle="modal" data-target="#modalTambahJurusan"
                                        class="btn rounded btn-success">Tambah Jurusan
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
                                            <th>Nama Jurusan</th>
                                            <th>Jumlah Kelas</th>
                                            <th>Jumlah Siswa Jurusan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataJurusan as $jurusan)
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>{{ $jurusan->nama_jurusan }}</td>
                                                <td>{{ $jurusan->countKelas() }}</td>
                                                <td>{{ $jurusan->countSiswa() }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalDetailJurusan-{{ $jurusan->id }}">
                                                        Detail
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modalEditJurusan-{{ $jurusan->id }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modalDeleteJurusan-{{ $jurusan->id }}">
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

        {{-- Modal Tambah Data Jurusan --}}
        <div class="modal fade" id="modalTambahJurusan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('jurusan.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahJurusan">Tambah Jurusan</h5>
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
                                            <label for="nama_jurusan">Nama Jurusan</label>
                                            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control"
                                                placeholder="Nama Jurusan">
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


        {{-- Modal Detail Jurusan --}}
        @foreach ($dataJurusan as $jurusan)
            <div class="modal fade" id="modalDetailJurusan-{{ $jurusan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDetailJurusanLabel-{{ $jurusan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailJurusanLabel{{ $jurusan->id }}">Detail Jurusan
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
                                                <label for="nama_jurusan">Nama Jurusan</label>
                                                <input type="text" name="nama_jurusan" id="nama_jurusan" disabled
                                                    class="form-control" value="{{ $jurusan->nama_jurusan }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="jumlah_kelas">Jumlah Kelas</label>
                                                <input type="text" name="jumlah_kelas" id="jumlah_kelas" disabled
                                                    class="form-control" value="{{ $jurusan->countKelas() }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="jumlah_siswa">Jumlah Siswa Jurusan</label>
                                                <input type="text" name="jumlah_siswa" id="jumlah_siswa" disabled
                                                    class="form-control" value="{{ $jurusan->countSiswa() }}">
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

        {{-- Modal Edit Jurusan --}}
        @foreach ($dataJurusan as $jurusan)
            <div class="modal fade" id="modalEditJurusan-{{ $jurusan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalEditJurusanLabel-{{ $jurusan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalJurusanLabel{{ $jurusan->nama_jurusan }}">Edit
                                    Jurusan</h5>
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
                                                <label for="nama_jurusan">Nama Jurusan</label>
                                                <input type="text" name="nama_jurusan" id="nama_jurusan"
                                                    class="form-control" value="{{ $jurusan->nama_jurusan }}">
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

        {{-- Modal Delete Jurusan --}}
        @foreach ($dataJurusan as $jurusan)
            <div class="modal fade" id="modalDeleteJursan-{{ $jurusan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDeleteJurusanLabel-{{ $jurusan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('jurusan.delete', $jurusan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteJurusanLabel{{ $jurusan->id }}">Delete Jurusan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus jurusan <br>
                                    <b>{{ $jurusan->nama_jurusan }} </b>
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

    <!-- Page Specific JS File -->
@endpush
