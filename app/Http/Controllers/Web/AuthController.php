<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Petugas;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {
        $pengguna = $request->pengguna;

        $credentials = $this->validate($request, [
            'username' => ['required'],
            'password' => ['required'],
            'pengguna' => ['required', Rule::in(['admin', 'petugas', 'siswa'])],
        ]);

        $username = $credentials['username'];
        $password = $credentials['password'];
        $level    = $credentials['pengguna'];

        // check user
        switch ($pengguna) {
            case 'admin':
                $found = Petugas::getUser($username, $password);

                if (!$found) {
                    return back()->with('error', 'User tidak ditemukan');
                } else {
                    $id_user  = Petugas::getUser($username, $password)->id;

                    $request->session()->put('user', $credentials);
                    $request->session()->put('id', $id_user);
                    $request->session()->put('level', $level);
                    notify()->success('Selamat Anda Berhasil Login');
                    // smilify('success', 'Selamat anda berhasil login');
                    // emotify('success', 'Selamat Anda Berhasil Update Siswa');
                    return redirect()->intended('/dashboard-admin');
                }
                break;

            case 'petugas':
                $found = Petugas::getUser($username, $password);

                if (!$found) {
                    return back()->with('error', 'User tidak ditemukan');
                } else {
                    $id_user  = Petugas::getUser($username, $password)->id;

                    $request->session()->put('user', $credentials);
                    $request->session()->put('id', $id_user);
                    $request->session()->put('level', $level);
                    notify()->success('Selamat Anda Berhasil Login');
                    return redirect()->intended('/dashboard-petugas');
                }
                break;

            case 'siswa':
                $found = Siswa::getUser($username, $password);

                if (!$found) {
                    return back()->with('error', 'User tidak ditemukan');
                } else {
                    $id_siswa = Siswa::getUser($username, $password)->id;

                    $request->session()->put('user', $credentials);
                    $request->session()->put('id_siswa', $id_siswa);
                    notify()->success('Selamat Anda Berhasil Login');
                    return redirect()->intended('/dashboard-siswa');
                }
                break;

            default:
                return 'Level Pengguna Tidak Tersedia';
                break;
        }

        // return redirect()->intended('/home');
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/dashboard');
        // }

        // return back()->with('loginError', 'Login gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
