<?php

namespace App\Models;

use App\Models\Spp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdf extends Model
{
    use HasFactory;

    // public static function sppPdf()
    // {
    //     $spp = Spp::getAll();
    //     $pdf = PDF::loadView('spp.pdf');
    //     $mpdf = $pdf->getMpdf();

    //     $mpdf->AddPage();
    //     $html = view('pages.laporan.sppPdf', ['spp' => $spp])->render();
    //     $mpdf->WriteHTML($html);

    //     return $pdf->stream();
    // }
}
