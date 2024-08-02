<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::totalSiswa();
        $totalKelas = Kelas::totalKelas();
        $totalProdi = Jurusan::totalProdi();
        $jumlahBelumLunas = Spp::jumlahBelumLunas();
        $jumlahSaldo = Spp::jumlahSaldo();
        return view('pages.petugas.dashboard-petugas', compact('totalSiswa', 'totalKelas', 'totalProdi', 'jumlahBelumLunas', 'jumlahSaldo'), ['type_menu' => 'dashboard']);
    }
}
