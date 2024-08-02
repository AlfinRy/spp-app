<?php

namespace App\Models;

use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = ['id_siswa', 'id_petugas', 'tgl_transaksi', 'nominal', 'total_bayar', 'bulan', 'status', 'created_by', 'updated_by'];

    public static function getAll()
    {
        $data = Spp::orderBy('tgl_transaksi', 'DESC')->with('siswa')->with('petugas')->get();
        return $data;
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public static function getById($id)
    {
        $found = Spp::where('id', $id)->get();

        if (!$found) {
            abort(404, 'Spp tidak ditemukan');
        }

        return $found;
    }

    public static function jumlahSaldo()
    {
        $count = Spp::sum('total_bayar');

        return $count;
    }

    public static function jumlahBelumLunas()
    {
        $count = Spp::where('status', 'Belum')->count();

        return $count;
    }

    public static function sppSiswaBelumLunas($id)
    {
        $count = Spp::where('id_siswa', $id)->where('status', 'Belum')->count();

        return $count;
    }

    public static function jumlahTransaksiByBulan()
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $count = Spp::whereBetween('created_at', [$startDate, $endDate])->count();

        return $count;
    }

    public static function addSpp(Request $request)
    {
        $spp = new Spp;
        $spp->id_siswa      = $request->id_siswa;
        $spp->id_petugas    = $request->id_user;
        $spp->bulan         = $request->bulan;
        $spp->nominal       = $request->nominal;
        $spp->status        = 'Belum';
        $spp->created_by    = $request->id_user;

        $spp->save();
        smilify('success', 'Selamat Anda Berhasil Menambah Spp');
        return redirect()->back();
    }

    public static function updateSpp($request, $id)
    {
        $spp = Spp::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'id_siswa'          => 'required',
            'bulan'             => 'required',
            'tgl_transaksi'     => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $spp->id_siswa          = $request->id_siswa;
        $spp->bulan             = $request->bulan;
        $spp->tgl_transaksi     = $request->tgl_transaksi;
        $spp->updated_by        =  $request->id_user;

        $spp->update();
        smilify('success', 'Selamat Anda Berhasil Update Spp');
        return redirect()->intended('/table-spp')->with('success', 'Data berhasil disimpan');
    }

    public static function bayarSpp(Request $request, $id)
    {
        $spp = Spp::getById($id)->first();

        $validator = Validator::make($request->all(), [
            'tgl_transaksi'   => 'required',
            'total_bayar'     => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $spp->status        =  'Sudah';
        $spp->tgl_transaksi =  $request->tgl_transaksi;
        $spp->total_bayar   =  $request->total_bayar;
        $spp->updated_by    =  $request->id_user;

        $spp->update();
        smilify('success', 'Selamat Anda Berhasil Membayar SPP');
        return redirect()->back();
    }

    public static function deleteSpp($id)
    {
        $siswa = Spp::getById($id)->first();
        $siswa->delete();

        smilify('success', 'Selamat Anda Berhasil Menghapus Spp');
        return redirect()->intended('/table-spp')->with('success', 'Data berhasil dihapus');
    }

    public static function sppPdf()
    {
        $mpdf = new Mpdf();

        $spp = Spp::getAll();
        $view = view('pages.laporan.sppPdf', ['spp' => $spp]);

        $mpdf->AddPage("L", "", "", "", "", "15", "15", "5", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
