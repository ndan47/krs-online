<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class MatkulController extends ResourceController
{
    protected $db;
    protected $format = 'json';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index()
    {
        $query = $this->db->query("SELECT * FROM mata_kuliah");
        $result = $query->getResult();

        return $this->respond([
            'message' => 'success',
            'data_matkul' => $result
        ], 200);
    }

    public function show($id = null)
    {
        $query = $this->db->query("SELECT * FROM mata_kuliah WHERE id_matkul = ?", [$id]);
        $row = $query->getRow();

        if ($row === null) {
            return $this->failNotFound('Data mata kuliah tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'matkul_byid' => $row
        ], 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'semester' => 'required',
            'nama_matkul' => 'required',
            'banyak_sks' => 'required',
            'banyak_jam_matkul' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query(
            "INSERT INTO mata_kuliah (semester, nama_matkul, banyak_sks, banyak_jam_matkul, keterangan) VALUES (?, ?, ?, ?, ?)",
            [
                $this->request->getVar('semester'),
                $this->request->getVar('nama_matkul'),
                $this->request->getVar('banyak_sks'),
                $this->request->getVar('banyak_jam_matkul'),
                $this->request->getVar('keterangan')
            ]
        );

        return $this->respondCreated([
            'message' => 'Data mata kuliah berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $check = $this->db->query("SELECT * FROM mata_kuliah WHERE id_matkul = ?", [$id])->getRow();
        if ($check === null) {
            return $this->failNotFound('Data matkul tidak ditemukan');
        }

        $rules = $this->validate([
            'semester' => 'required',
            'nama_matkul' => 'required',
            'banyak_sks' => 'required',
            'banyak_jam_matkul' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query(
            "UPDATE mata_kuliah SET semester = ?, nama_matkul = ?, banyak_sks = ?, banyak_jam_matkul = ?, keterangan = ? WHERE id_matkul = ?",
            [
                $this->request->getVar('semester'),
                $this->request->getVar('nama_matkul'),
                $this->request->getVar('banyak_sks'),
                $this->request->getVar('banyak_jam_matkul'),
                $this->request->getVar('keterangan'),
                $id
            ]
        );

        return $this->respond([
            'message' => 'Data matkul berhasil diubah'
        ], 200);
    }

    public function delete($id = null)
    {
        $check = $this->db->query("SELECT * FROM mata_kuliah WHERE id_matkul = ?", [$id])->getRow();
        if ($check === null) {
            return $this->failNotFound('Data matkul tidak ditemukan');
        }

        $this->db->query("DELETE FROM mata_kuliah WHERE id_matkul = ?", [$id]);

        return $this->respondDeleted([
            'message' => 'Data matkul berhasil dihapus'
        ]);
    }
}