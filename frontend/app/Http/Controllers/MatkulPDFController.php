<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;


class MatkulPDFController extends Controller
{
    public function exportPdf()
    {
        // Ambil Data Dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/matkul');
        $data = $response->json();

        // Ambil hanya data_prodi
        $matkulData = $data['data_matkul'] ?? [];

        //Load View dan Kirim Data
        $pdf = PDF::loadView('pdf.matkul', compact('matkulData'));

        //download pdf dengan nama file nya
        return $pdf->download('Data_Mata_Kuliah.pdf');
    }
}
