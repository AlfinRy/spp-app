<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        $id = session('id_siswa');
        $sppSiswa = Spp::sppSiswaBelumLunas($id);
        $jumlahSaldo = Spp::jumlahSaldo();
        return view('pages.siswa.dashboard-siswa', compact('jumlahSaldo', 'sppSiswa'), ['type_menu' => 'dashboard']);
    }
}
