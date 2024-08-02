<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'users_petugas';

    protected $fillable = ['username', 'password', 'nama_petugas', 'level'];

    protected $hidden = ['password'];

    public static function getUser($username, $password)
    {
        $found = Petugas::where('username', $username)->where('password', $password)->first();

        return $found;
    }

    public static function getAll()
    {
        $data = Petugas::orderBy('id', 'ASC')->get();
        return $data;
    }

    public function checkUsername($username, $exception = null)
    {
        $found = Petugas::where('username', $username);
        if ($exception) {
            $found->where('id', '!=', $exception);
        }

        $found = $found->first();

        if ($found) {
            abort(400, 'Username sudah ada');
        }
    }

    public static function getById($id)
    {
        $found = Petugas::where('id', $id)->get();

        if (!$found) {
            abort(404, 'Petugas tidak ditemukan');
        }

        return $found;
    }

    public static function addUser(Request $request)
    {
        Petugas::checkUsername($request->username);

        $petugas = new Petugas;
        $petugas->username =  $request->username;
        $petugas->password =  $request->password;
        $petugas->nama_petugas =  $request->nama_petugas;
        $petugas->level =  $request->level;
        $petugas->created_by =  $request->id_user;

        $petugas->save();
        smilify('success', 'Selamat Anda Berhasil Menambah Petugas');
        return redirect()->back();
    }

    public static function updateUser(Request $request, $id)
    {
        $petugas = Petugas::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'username'      => 'required',
            'password'      => 'required',
            'nama_petugas'  => 'required',
            'level'         => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $petugas->username =  $request->username;
        $petugas->password =  $request->password;
        $petugas->nama_petugas =  $request->nama_petugas;
        $petugas->level =  $request->level;
        $petugas->created_by =  $request->id_user;

        $petugas->update();
        smilify('success', 'Selamat Anda Berhasil Update Petugas');
        return redirect()->back();
    }

    public static function deleteUser($id)
    {
        $petugas = Petugas::getById($id)->first();
        $petugas->delete();

        smilify('success', 'Selamat Anda Berhasil Menghapus Petugas');
        return redirect()->back();
    }
}
