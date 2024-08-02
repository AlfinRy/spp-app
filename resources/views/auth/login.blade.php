@extends('layouts.auth_app')
@section('title')
    Login
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header d-flex flex-column">
            <h4>Login</h4>
            <h4>Pembayaran SPP</h4>
        </div>

        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="las la-times close" style="font-size: 1.2rem"></i>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="las la-times close" style="font-size: 1.2rem"></i>
                    </button>
                </div>
            @endif
            <form action="{{ url('login') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" class="form-control" tabindex="1" required
                        autofocus>
                    <div class="invalid-feedback">
                        Please fill in your username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        {{-- <div class="float-right">
                            <a href="auth-forgot-password.html"
                                class="text-small">
                                Forgot Password?
                            </a>
                        </div> --}}
                    </div>
                    <div class="input-group">
                        <input id="password" type="password" name="password" class="form-control" tabindex="2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="las la-eye" style="font-size: 1.2rem" id="show_eye"></i>
                                <i class="las la-eye-slash d-none" style="font-size: 1.2rem" id="hide_eye"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pengguna" class="">Pengguna</label>
                    <select name="pengguna" id="pengguna" class="custom-select">
                        <option hidden>Pilih Pengguna</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="siswa">Siswa</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select your option
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="remember"
                            class="custom-control-input"
                            tabindex="3"
                            id="remember-me">
                        <label class="custom-control-label"
                            for="remember-me">Remember Me</label>
                    </div>
                </div> --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                </div>
            </form>
            {{-- <div class="text-muted mt-2 text-center">
                Tidak punya akun? <a href="{{url('auth-register')}}">Ayo Buat!</a>
            </div> --}}
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        $(document).ready(function() {
            $('.selectize').selectize();
        });

        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
    <!-- Page Specific JS File -->
@endpush
