<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class MahasiswaPDFController extends Controller
{
    public function exportPdf()
    {
        // Ambil Data Dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/mahasiswa');
        $data = $response->json();

        // Ambil hanya mahasiswa
        $mahasiswaData = $data['data_mahasiswa'] ?? [];

        //Load View dan Kirim Data
        $pdf = PDF::loadView('pdf.mahasiswa', compact('mahasiswaData'));

        //download pdf dengan nama file nya
        return $pdf->download('Data_Mahasiswa.pdf');
    }
}
