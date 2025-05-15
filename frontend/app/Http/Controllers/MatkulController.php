<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://localhost:8080/api/matkul');
        if ($response->successful()) {
            $datas = $response->json();
            return view('mata_kuliah.index', compact('datas'));
        }
        return response()->json(['error' => 'Gagal Mengambil Data dari API'], 500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mata_kuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|integer',
            'nama_matkul' => 'required|string|max:255',
            'banyak_sks' => 'required|integer',
            'banyak_jam_matkul' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $response = Http::post('http://localhost:8080/api/matkul', [
            'semester' => $request->semester,
            'nama_matkul' => $request->nama_matkul,
            'banyak_sks' => $request->banyak_sks,
            'banyak_jam_matkul' => $request->banyak_jam_matkul,
            'keterangan' => $request->keterangan,
        ]);
        if ($response->successful()) {
            return redirect()->route('matkul.index')->with('success', 'Data Berhasil Ditambahkan!');
        }

        return back()->with('error', 'Gagal Menambahkan data');
    }

    public function edit(string $id)
    {
        $response = Http::get('http://localhost:8080/api/matkul/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('mata_kuliah.edit', ['matkul' => $data['matkul_byid']]);
        }
        return response()->json(['error' => 'gagal Fetch data'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'semester' => 'required|integer',
            'nama_matkul' => 'required|string|max:255',
            'banyak_sks' => 'required|integer',
            'banyak_jam_matkul' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $response = Http::put('http://localhost:8080/api/matkul/' . $id, [
            'semester' => $request->semester,
            'nama_matkul' => $request->nama_matkul,
            'banyak_sks' => $request->banyak_sks,
            'banyak_jam_matkul' => $request->banyak_jam_matkul,
            'keterangan' => $request->keterangan,
        ]);

        if ($response->successful()) {
            return redirect()->route('matkul.index')->with('success', 'Data Berhasil di update');
        }
        return back()->with('error', 'Gagal Menambahkan data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('http://localhost:8080/api/matkul/' . $id);

        if ($response->successful()) {
            return redirect()->route('matkul.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Gagal Menghapus data');
    }
}
