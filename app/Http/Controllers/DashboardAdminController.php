<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::totalSiswa();
        $totalKelas = Kelas::totalKelas();
        $totalProdi = Jurusan::totalProdi();
        $jumlahBelumLunas = Spp::jumlahBelumLunas();
        $jumlahSaldo = Spp::jumlahSaldo();
        $jumlahTransaksi = Spp::jumlahTransaksiByBulan();
        return view('pages.admin.dashboard-admin', compact('totalSiswa', 'totalKelas', 'totalProdi', 'jumlahBelumLunas', 'jumlahSaldo', 'jumlahTransaksi'), ['type_menu' => 'dashboard']);
    }
}
