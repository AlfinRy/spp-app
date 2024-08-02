<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public static function example()
    {
        $dataSiswa = Siswa::all();
        return view('pages.bootstrap-form', compact('dataSiswa'), ['type_menu' => 'table_siswa']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSiswa = Siswa::getAll();
        $uniqueNamaKelas = Kelas::select('id', 'nama_kelas')->get();
        $jenisKelamin = ['Laki-Laki', 'Perempuan'];
        return view('pages.admin.table-siswa', compact('dataSiswa', 'uniqueNamaKelas', 'jenisKelamin'), ['type_menu' => 'table_siswa']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Siswa::addUser($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $siswa = Siswa::find($nis);

        return response()->json($siswa);
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
        return Siswa::updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Siswa::deleteUser($id);
    }
}
