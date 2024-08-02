<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = ['nama_jurusan'];

    public static function totalJurusan()
    {
        return Jurusan::count();
    }

    public static function getAll()
    {
        $data = Jurusan::orderBy('id', 'ASC')->get();
        return $data;
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jurusan');
    }

    public function checkKelas($nama_kelas, $exception = null)
    {
        $found = Kelas::where('nama_kelas', $nama_kelas);
        if ($exception) {
            $found->where('id', '!=', $exception);
        }

        $found = $found->first();

        if ($found) {
            abort(400, 'Kelas sudah ada');
        }
    }

    public static function totalProdi()
    {
        return Jurusan::count();
    }

    public static function getById($id)
    {
        $found = Jurusan::where('id', $id)->get();

        if (!$found) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        return $found;
    }

    public static function addJurusan(Request $request)
    {
        $jurusan = new Jurusan;
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->created_by = $request->id_user;

        $jurusan->save();
        smilify('success', 'Selamat Anda Berhasil Menambah Jurusan');
        return redirect()->back();
    }

    public static function updateJurusan(Request $request, $id)
    {
        $jurusan = Jurusan::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'nama_jurusan'  => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $jurusan->nama_jurusan =  $request->nama_jurusan;
        $jurusan->updated_by = $request->id_user;

        $kelas->update();
        smilify('success', 'Selamat Anda Berhasil Update Jurusan');
        return redirect()->back();
    }

    public static function deleteJurusan($id)
    {
        $jurusan = Jurusan::getById($id)->first();
        $jurusan->delete();

        smilify('success', 'Selamat Anda Berhasil Menghapus Jurusan');
        return redirect()->back();
    }

    public function countKelas()
    {
        return $this->kelas()->count();
    }

    public function countSiswa()
    {
        $siswa = 0;
        $kelas = $this->kelas()->get();
        foreach ($kelas as $key => $value) {
            $siswa += $value->countSiswa();
        }
        return $siswa;
    }
}
