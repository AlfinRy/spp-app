<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSpp = Spp::getAll();
        $namaSiswa = Siswa::getAll();
        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        // $namaSiswa = Siswa::select('id', 'nama', 'id_kelas')->get();
        return view('pages.admin.table-spp', compact('dataSpp', 'namaSiswa', 'namaBulan'), ['type_menu' => 'table_spp']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Spp::addSpp($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Spp::updateSpp($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Spp::deleteSpp($id);
    }

    public function bayarSpp(Request $request, $id)
    {
        return Spp::bayarSpp($request, $id);
    }

    public static function sppSiswaBelumLunas($id)
    {
        return Spp::sppSiswaBelumLunas($id);
    }
}
