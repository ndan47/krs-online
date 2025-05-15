<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/api/mahasiswa');

        $responseProdi = Http::get('http://localhost:8080/api/prodi');

        if ($response->successful() && $responseProdi->successful()){
            $datas = $response->json();
            $datas['data_prodi'] = $responseProdi->json()['data_prodi'];
            
            return view('mahasiswa.index', compact('datas'));
        }
        return response()->json(['error' => 'Gagal Mengambil Data Dari API'], 500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Http::get('http://localhost:8080/api/prodi');

        if ($response->successful()){
            $datas = $response->json()['data_prodi'];
            return view('mahasiswa.create', compact('datas'));
        }
        return redirect()->back()->with('error', 'Gagal mengambil data Program Studi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NPM' => 'required|string|max:255',
            'nama_mahasiswa' => 'required|string|max:255',
            'alamat_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
        ]);
        $response = Http::post('http://localhost:8080/api/mahasiswa',[
            'NPM' => $request->NPM,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
            'id_prodi' => $request->id_prodi,
            // 'nama_prodi' => $request->nama_prodi,
        ]);

        if($response->successful()){
            return redirect()->route('mahasiswa.index')->with('success', 'data berhasil ditambahkan');
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
        $responseMahasiswa = Http::get('http://localhost:8080/api/mahasiswa/' . $id);

        $responseProdi = Http::get('http://localhost:8080/api/prodi');
        
        if($responseMahasiswa->successful() && $responseProdi->successful()){
            $mahasiswa = $responseMahasiswa->json()['mhs_byid'];
            $prodi = $responseProdi->json()['data_prodi'];
            return view('mahasiswa.edit', compact('mahasiswa', 'prodi'));
        }
        return response()->json(['error' => 'gagal fetch data'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NPM' => 'required|string|max:255',
            'nama_mahasiswa' => 'required|string|max:255',
            'alamat_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
        ]);
        $response = Http::put('http://localhost:8080/api/mahasiswa/' . $id, [
            'NPM' => $request->NPM,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
            'id_prodi' => $request->id_prodi,
        ]);

        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data Berhasil di update');
        }
        return back()->with('error', 'Gagal Mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('http://localhost:8080/api/mahasiswa/' . $id);

        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Gagal Menghapus data');
    }
}