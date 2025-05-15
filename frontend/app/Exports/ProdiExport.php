<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

class ProdiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/prodi');
        $data = $response->json(); // Convert JSON ke array

        // Ambil hanya 'data_prodi' dan ubah formatnya
        $prodiData = collect($data['data_prodi'] ?? [])->map(function ($item) {
            return [
                $item['id_prodi'] ?? null,
                $item['nama_prodi'] ?? null
            ];
        });
        // Pastikan data dalam bentuk koleksi Laravel
        return collect($prodiData);
        
    }

    public function headings(): array{
        return ["ID Prodi", "Nama Prodi"];
    }
}
