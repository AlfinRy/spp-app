<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['nama_kelas', 'id_jurusan'];

    public static function totalKelas()
    {
        return Kelas::count();
    }

    public static function getAll()
    {
        $data = Kelas::orderBy('id', 'ASC')->with('jurusan')->get();
        return $data;
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
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

    public static function getById($id)
    {
        $found = Kelas::where('id', $id)->get();

        if (!$found) {
            abort(404, 'Kelas tidak ditemukan');
        }

        return $found;
    }

    public static function addKelas(Request $request)
    {
        Kelas::checkKelas($request->nama_kelas);

        $kelas = new Kelas;
        $kelas->nama_kelas =  $request->nama_kelas;
        $kelas->id_jurusan =  $request->id_jurusan;
        $kelas->created_by =  $request->id_user;

        $kelas->save();
        smilify('success', 'Selamat Anda Berhasil Menambah Kelas');
        return redirect()->back();
    }

    public static function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'nama_kelas'   => 'required',
            'id_jurusan'   => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $kelas->nama_kelas =  $request->nama_kelas;
        $kelas->id_jurusan =  $request->id_jurusan;
        $kelas->updated_by =  $request->id_user;

        $kelas->update();
        smilify('success', 'Selamat Anda Berhasil Update Kelas');
        return redirect()->back();
    }

    public static function deleteKelas($id)
    {
        $kelas = Kelas::getById($id)->first();
        $kelas->delete();

        smilify('success', 'Selamat Anda Berhasil Menghapus Kelas');
        return redirect()->back();
    }

    public function countSiswa()
    {
        return $this->siswa()->count();
    }
}
