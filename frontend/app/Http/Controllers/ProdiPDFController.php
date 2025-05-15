<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class ProdiPDFController extends Controller
{
    public function exportPdf() {
        // Ambil Data Dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/prodi');
        $data = $response->json();

        // Ambil hanya data_prodi
        $prodiData = $data['data_prodi'] ?? [];

        //Load View dan Kirim Data
        $pdf = PDF::loadView('pdf.prodi', compact('prodiData'));

        //download pdf dengan nama file nya
        return $pdf->download('Data_Prodi.pdf');
    }
}
