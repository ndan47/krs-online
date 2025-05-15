<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://localhost:8080/api/prodi', [
            'sort_by' => 'id',
            'order' => 'asc'
        ]);
        if ($response->successful()) {
            $datas = collect($response->json())->sortByDesc('id');
            return view('program_studi.index', compact('datas'));
        }
        return response()->json(['error' => 'Gagal Mengambil Data dari API'], 500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_studi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
        ]);
        $response = Http::post('http://localhost:8080/api/prodi', [
            'nama_prodi' => $request->nama_prodi,
        ]);
        if ($response->successful()) {
            return redirect()->route('prodi.index')->with('success', 'Data Berhasil Ditambahkan!');
        }

        return back()->with('error', 'Gagal Menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::get('http://localhost:8080/api/prodi/' . $id);

        if ($response->successful()){
            $data = $response->json();
            return view('program_studi.edit', ['prodi'=> $data['prodi_byid']]);
        }
        return response()->json(['error' => 'gagal Fetch data'],500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
        ]);
        $response = Http::put('http://localhost:8080/api/prodi/'. $id,[
            'nama_prodi' => $request->nama_prodi,
        ]);

        if ($response->successful()){
            return redirect()->route('prodi.index')->with('success', 'Data Berhasil di update');
        }
        return back()->with('error', 'Gagal Mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('http://localhost:8080/api/prodi/' . $id);

        if ($response->successful()) {
            return redirect()->route('prodi.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Gagal Menghapus data');
    }
}