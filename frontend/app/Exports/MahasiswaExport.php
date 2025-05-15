<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil data dari API CodeIgniter
        $response = Http::get('http://localhost:8080/api/mahasiswa');
        $data = $response->json(); // Convert JSON ke array

        // Ambil hanya 'data_prodi' dan ubah formatnya
        $mahasiswaData = collect($data['data_mahasiswa'] ?? [])->map(function ($item) {
            return [
                $item['NPM'] ?? null,
                $item['nama_mahasiswa'] ?? null,
                $item['alamat_mahasiswa'] ?? null,
                $item['id_prodi'] ?? null
            ];
        });
        // Pastikan data dalam bentuk koleksi Laravel
        return collect($mahasiswaData);
    }

    public function headings(): array
    {
        return ["NPM", "Nama Mahasiswa", "Alamat Mahasiswa", "Nama Prodi"];
    }
}
