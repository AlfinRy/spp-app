@extends('layouts.admin.app')

@section('title', 'Tabel Petugas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Petugas</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <button type="button" data-toggle="modal" data-target="#modalTambahPetugas"
                                        class="btn rounded btn-success">Tambah Petugas
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
                                            <th>Username</th>
                                            <th>Nama Petugas</th>
                                            <th>Level</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($dataPetugas as $petugas)
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>{{ $petugas->username }}</td>
                                                <td>{{ $petugas->nama_petugas }}</td>
                                                <td>{{ $petugas->level }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalDetailPetugas-{{ $petugas->id }}">
                                                        Detail
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modalEditPetugas-{{ $petugas->id }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modalDeletePetugas-{{ $petugas->id }}">
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

        {{-- Modal Tambah Data Petugas --}}
        <div class="modal fade" id="modalTambahPetugas" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahPetugas">Tambah Petugas</h5>
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
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nama_petugas">Nama Petugas</label>
                                            <input type="text" name="nama_petugas" id="nama_petugas" class="form-control"
                                                placeholder="Nama Petugas">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input id="password" type="password" name="password"
                                                    class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="password_show_hide();">
                                                        <i class="las la-eye" style="font-size: 1.2rem"
                                                            id="show_eye"></i>
                                                        <i class="las la-eye-slash d-none" style="font-size: 1.2rem"
                                                            id="hide_eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="level">Level</label>
                                            <select name="level" id="level" class="form-control">
                                                <option hidden selected>Pilih !</option>
                                                @foreach ($namaLevel as $level)
                                                    <option value="{{ $level }}">
                                                        {{ $level }}</option>
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


        {{-- Modal Detail Siswa --}}
        @foreach ($dataPetugas as $petugas)
            <div class="modal fade" id="modalDetailPetugas-{{ $petugas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDetailPetugasLabel-{{ $petugas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailPetugasLabel{{ $petugas->id }}">Detail Petugas
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
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" disabled
                                                    class="form-control" value="{{ $petugas->username }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama_petugas">Nama Petugas</label>
                                                <input type="text" name="nama_petugas" id="nama_petugas" disabled
                                                    class="form-control" value="{{ $petugas->nama_petugas }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="level">Level</label>
                                                <input type="text" name="level" id="level" disabled
                                                    class="form-control" value="{{ $petugas->level }}">
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

        {{-- Modal Edit Petugas --}}
        @foreach ($dataPetugas as $petugas)
            <div class="modal fade" id="modalEditPetugas-{{ $petugas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalEditPetugasLabel-{{ $petugas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPetugasSiswaLabel{{ $petugas->nama_petugas }}">Edit
                                    Petugas</h5>
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
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username"
                                                    class="form-control" value="{{ $petugas->username }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama_petugas">Nama Petugas</label>
                                                <input type="text" name="nama_petugas" id="nama_petugas"
                                                    class="form-control" value="{{ $petugas->nama_petugas }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="e_password">Password</label>
                                                <div class="input-group">
                                                    <input id="e_password-{{ $petugas->id }}" type="password"
                                                        name="password" class="form-control"
                                                        value="{{ $petugas->password }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            onclick="password_show_hide({{ $petugas->id }});">
                                                            <i class="las la-eye" style="font-size: 1.2rem"
                                                                id="show_eye"></i>
                                                            <i class="las la-eye-slash d-none" style="font-size: 1.2rem"
                                                                id="hide_eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="level">Level</label>
                                                <select name="level" id="level" class="form-control">
                                                    <option hidden selected>Pilih !</option>
                                                    @foreach ($namaLevel as $level)
                                                        <option {{ $petugas->level === $level ? 'selected' : '' }}
                                                            value="{{ $level }}">
                                                            {{ $level }}</option>
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

        {{-- Modal Delete Petugas --}}
        @foreach ($dataPetugas as $petugas)
            <div class="modal fade" id="modalDeletePetugas-{{ $petugas->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalDeletePetugasLabel-{{ $petugas->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('petugas.delete', $petugas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeletePetugasLabel{{ $petugas->id }}">Delete Petugas
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus petugas <br>
                                    <b>{{ $petugas->nama_petugas }} </b>
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
        <script>
            function password_show_hide(id) {
                var x = document.getElementById("password");
                var y = document.getElementById("e_password-" + id);
                var show_eye = document.getElementById("show_eye");
                var hide_eye = document.getElementById("hide_eye");
                hide_eye.classList.remove("d-none");
                if (x.type === "password" || y.type === "password") {
                    x.type = "text";
                    y.type = "text";
                    show_eye.style.display = "none";
                    hide_eye.style.display = "block";
                } else {
                    x.type = "password";
                    y.type = "password";
                    show_eye.style.display = "block";
                    hide_eye.style.display = "none";
                }
            }
        </script>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
