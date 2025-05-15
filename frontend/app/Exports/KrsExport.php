<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KrsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data dari API
        $response = Http::get('http://localhost:8080/api/pengisian-krs');

        $data = $response->json();

        // Ubah format data biar rapi di Excel
        $krsData = collect($data['data_pengisian_krs'] ?? [])->map(function ($item) {
            return [
                $item['timestamp'] ?? null,
                $item['tahun_akademik'] ?? null,
                $item['NPM'] ?? null,
                $item['nama_mahasiswa'] ?? null, 
                $item['nama_prodi'] ?? null,
                $item['semester'] ?? null,
                $item['nama_matkul'] ?? null,   
                $item['banyak_sks'] ?? null,     
                $item['banyak_jam_matkul'] ?? null,     
                $item['keterangan'] ?? null,     
            ];
        });

        return collect($krsData);
    }

    public function headings(): array
    {
        return [
            'Waktu',
            'Tahun Akademik',
            'NPM',
            'Nama Mahasiswa',
            'Nama Prodi',
            'Semester',
            'Nama Mata Kuliah',
            'Banyak SKS',
            'Banyak Jam Mata Kuliah',
            'Keterangan',
        ];
    }
}
