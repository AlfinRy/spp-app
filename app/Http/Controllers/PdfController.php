<?php

namespace App\Http\Controllers;

use PDF;
use Mpdf\Mpdf;
use App\Models\Spp;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    function sppPdf()
    {
        $spp = Spp::getAll();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors = true;
        $html = view('pages.laporan.sppPdf', ['spp' => $spp])->render();
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "5", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
