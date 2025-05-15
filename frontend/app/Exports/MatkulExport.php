<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

class MatkulExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil data dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/matkul');
        $data = $response->json(); // Convert JSON ke array

        // Ambil hanya 'data_matkul' dan ubah formatnya
        $matkulData = collect($data['data_matkul'] ?? [])->map(function ($item) {
            return [
                $item['id_matkul'] ?? null,
                $item['semester'] ?? null,
                $item['nama_matkul'] ?? null,
                $item['banyak_sks'] ?? null,
                $item['banyak_jam_matkul'] ?? null,
                $item['keterangan'] ?? null
            ];
        });
        // Pastikan data dalam bentuk koleksi Laravel
        return collect($matkulData);
  
    }

    public function headings(): array
    {
        return ["ID Matkul", "Semester", "Nama Mata Kuliah", "Banyak SKS", "Banyak Jam Matkul", "Keterangan"];
    }
}
