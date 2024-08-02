<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'users_siswa';

    protected $fillable = ['nis', 'nama', 'jenis_kelamin', 'id_kelas', 'alamat', 'no_telp', 'created_by', 'updated_by'];

    public static function getAll()
    {
        $data = Siswa::orderBy('nis', 'ASC')->with('kelas')->get();
        return $data;
    }

    public static function getUser($username, $password)
    {
        $found = Siswa::where('username', $username)->where('nis', $password)->first();

        return $found;
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function checkNis($nis, $exception = null)
    {
        $found = Siswa::where('nis', $nis);
        if ($exception) {
            $found->where('id', '!=', $exception);
        }

        $found = $found->first();

        if ($found) {
            abort(400, 'NIS sudah ada');
        }
    }

    public static function totalSiswa()
    {
        return Siswa::count();
    }

    public static function totalSiswaByKelas($id)
    {
        return Siswa::where('id', $id)->count();
    }

    public static function getById($id)
    {
        $found = Siswa::where('id', $id)->get();

        if (!$found) {
            abort(404, 'Siswa tidak ditemukan');
        }

        return $found;
    }

    public static function addUser(Request $request)
    {
        Siswa::checkNis($request->nis);

        $siswa = new Siswa;
        $siswa->nis =  $request->nis;
        $siswa->username =  $request->username;
        $siswa->nama =  $request->nama;
        $siswa->jenis_kelamin =  $request->jenis_kelamin;
        $siswa->id_kelas =  $request->id_kelas;
        $siswa->no_telp =  $request->no_telp;
        $siswa->alamat =  $request->alamat;
        $siswa->created_by =  $request->id_user;

        $siswa->save();
        smilify('success', 'Selamat Anda Berhasil Menambah Siswa');
        return redirect()->back();
    }

    public static function updateUser(Request $request, $id)
    {
        $siswa = Siswa::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'nis'       => 'required',
            'nama'      => 'required',
            'id_kelas'  => 'required',
            'alamat'    => 'required',
            'no_telp'   => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $siswa->nis = $request->nis;
        $siswa->username = $request->username;
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->updated_by =  $request->id_user;

        $siswa->update();
        smilify('success', 'Selamat Anda Berhasil Update Siswa');
        return redirect()->intended('/table-siswa')->with('success', 'Data berhasil disimpan');
    }

    public static function deleteUser($id)
    {
        $siswa = Siswa::getById($id)->first();
        $siswa->delete();

        smilify('success', 'Selamat Anda Berhasil Menghapus Siswa');
        return redirect()->intended('/table-siswa')->with('success', 'Data berhasil dihapus');
    }
}
